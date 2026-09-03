<?php
require_once __DIR__ . '/elements/booking-security.php';

header('Content-Type: text/plain; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

$responseLanguage = isset($_POST['lang']) && in_array($_POST['lang'], array('ru', 'en', 'et'), true)
    ? $_POST['lang']
    : 'ru';

function booking_response($russian, $english, $estonian, $status = 200)
{
    global $responseLanguage;
    http_response_code($status);
    $messages = array('ru' => $russian, 'en' => $english, 'et' => $estonian);
    exit($messages[$responseLanguage]);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    booking_response('Метод не поддерживается.', 'Method not allowed.', 'Meetod ei ole lubatud.', 405);
}

$contentLength = isset($_SERVER['CONTENT_LENGTH']) ? (int) $_SERVER['CONTENT_LENGTH'] : 0;
if ($contentLength > 32768) {
    booking_response('Слишком большой объём данных.', 'The request is too large.', 'Päring on liiga mahukas.', 413);
}

$csrfToken = isset($_POST['csrf_token']) && is_string($_POST['csrf_token'])
    ? $_POST['csrf_token']
    : '';
if (!booking_verify_csrf($csrfToken)) {
    booking_response(
        'Сессия формы истекла. Обновите страницу и попробуйте снова.',
        'The form session has expired. Refresh the page and try again.',
        'Vormi seanss on aegunud. Värskendage lehte ja proovige uuesti.',
        403
    );
}

function booking_value($key, $maxLength)
{
    $value = isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
    $value = str_replace("\0", '', $value);
    return function_exists('mb_substr')
        ? mb_substr($value, 0, $maxLength, 'UTF-8')
        : substr($value, 0, $maxLength);
}

function booking_html($value)
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$name = booking_value('name', 80);
$service = booking_value('usl', 100);
$phone = booking_value('tel', 30);
$date = booking_value('date', 10);
$time = booking_value('time', 5);
$carNumber = booking_value('auto_number', 20);
$comment = booking_sanitize_comment(booking_value('message', 1000));
$website = booking_value('website', 200);

if ($website !== '') {
    booking_response('Заявка принята!', 'Request received!', 'Broneeringutaotlus on vastu võetud!');
}

$allowedServices = array(
    'Наружная мойка и чистка салона',
    'Наружная мойка',
    'Чистка салона',
    'Полировка кузова',
    'Полировка и восстановление фар',
    'Химчистка салона',
    'Химчистка двигателя',
    'Полная очистка автомобиля',
    'Покрытие воском',
    'Покрытие керамикой',
    'Покрытие защитной плёнкой',
    'Детейлинг автомобиля',
    'Детейлинг яхты'
);

$dateObject = DateTime::createFromFormat('!d.m.Y', $date);
$dateIsValid = $dateObject && $dateObject->format('d.m.Y') === $date;
$today = new DateTime('today');

if (
    $name === '' ||
    !in_array($service, $allowedServices, true) ||
    !preg_match('/^\+?[0-9\s()\-]{7,20}$/', $phone) ||
    !$dateIsValid ||
    $dateObject < $today ||
    !preg_match('/^(09|1[0-8]):00$/', $time)
) {
    booking_response(
        'Проверьте обязательные поля и попробуйте снова.',
        'Check the required fields and try again.',
        'Kontrollige kohustuslikke välju ja proovige uuesti.',
        422
    );
}

booking_start_session();
$lastSentAt = isset($_SESSION['booking_last_sent_at']) ? (int) $_SESSION['booking_last_sent_at'] : 0;
if ($lastSentAt > 0 && time() - $lastSentAt < 30) {
    header('Retry-After: ' . (30 - (time() - $lastSentAt)));
    booking_response(
        'Заявка уже отправлена. Подождите немного перед повторной отправкой.',
        'The request has already been sent. Please wait before sending another one.',
        'Taotlus on juba saadetud. Palun oodake enne uue taotluse saatmist.',
        429
    );
}

$retryAfter = booking_rate_limit(5, 600);
if ($retryAfter > 0) {
    header('Retry-After: ' . $retryAfter);
    booking_response(
        'Слишком много заявок. Попробуйте снова через несколько минут.',
        'Too many requests. Please try again in a few minutes.',
        'Liiga palju päringuid. Palun proovige mõne minuti pärast uuesti.',
        429
    );
}

$subject = 'Новая бронь с сайта Pirita Pesula';
$message = 'Имя: ' . booking_html($name) . '<br>';
$message .= 'Язык формы: ' . booking_html(strtoupper($responseLanguage)) . '<br>';
$message .= 'Услуга: ' . booking_html($service) . '<br>';
$message .= 'Телефон: ' . booking_html($phone) . '<br>';
$message .= 'Дата: ' . booking_html($date) . '<br>';
$message .= 'Время: ' . booking_html($time) . '<br>';
$message .= 'Номер машины: ' . booking_html($carNumber !== '' ? $carNumber : 'не указан') . '<br>';
if ($carNumber !== '') {
    $vehicleCheckUrl = 'https://mexire.ee/vehicle-check.php?number=' . rawurlencode($carNumber);
    $message .= 'Проверить автомобиль: <a href="' . booking_html($vehicleCheckUrl) . '" target="_blank" rel="noopener noreferrer">скопировать номер и открыть Transpordiamet</a><br>';
}
if ($comment !== '') {
    $message .= 'Сообщение: ' . nl2br(booking_html($comment)) . '<br>';
}

$to = 'chalovmirror@gmail.com, Continent-marina@mail.ru';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Pirita Pesula <no-reply@pirita-pesula.ee>' . "\r\n";

if (!mail($to, $subject, $message, $headers)) {
    booking_response(
        'Не удалось отправить заявку. Позвоните нам по телефону +372 5391 8434.',
        'The request could not be sent. Call us at +372 5391 8434.',
        'Taotlust ei õnnestunud saata. Helistage meile numbril +372 5391 8434.',
        500
    );
}

$_SESSION['booking_last_sent_at'] = time();
booking_response(
    'Заявка принята! Мы свяжемся с вами для подтверждения времени.',
    'Request received! We will contact you to confirm the time.',
    'Broneeringutaotlus on vastu võetud! Võtame teiega aja kinnitamiseks ühendust.'
);
