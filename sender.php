<?php
require_once __DIR__ . '/elements/booking-security.php';

header('Content-Type: text/plain; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Метод не поддерживается.');
}

$contentLength = isset($_SERVER['CONTENT_LENGTH']) ? (int) $_SERVER['CONTENT_LENGTH'] : 0;
if ($contentLength > 32768) {
    http_response_code(413);
    exit('Слишком большой объём данных.');
}

$csrfToken = isset($_POST['csrf_token']) && is_string($_POST['csrf_token'])
    ? $_POST['csrf_token']
    : '';
if (!booking_verify_csrf($csrfToken)) {
    http_response_code(403);
    exit('Сессия формы истекла. Обновите страницу и попробуйте снова.');
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
$comment = booking_value('message', 1000);
$website = booking_value('website', 200);

if ($website !== '') {
    exit('Заявка принята!');
}

$allowedServices = array(
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
    !preg_match('/^(09|1[0-9]):00$/', $time)
) {
    http_response_code(422);
    exit('Проверьте обязательные поля и попробуйте снова.');
}

booking_start_session();
$lastSentAt = isset($_SESSION['booking_last_sent_at']) ? (int) $_SESSION['booking_last_sent_at'] : 0;
if ($lastSentAt > 0 && time() - $lastSentAt < 30) {
    http_response_code(429);
    header('Retry-After: ' . (30 - (time() - $lastSentAt)));
    exit('Заявка уже отправлена. Подождите немного перед повторной отправкой.');
}

$subject = 'Новая бронь с сайта Pirita Pesula';
$message = 'Имя: ' . booking_html($name) . '<br>';
$message .= 'Услуга: ' . booking_html($service) . '<br>';
$message .= 'Телефон: ' . booking_html($phone) . '<br>';
$message .= 'Дата: ' . booking_html($date) . '<br>';
$message .= 'Время: ' . booking_html($time) . '<br>';
$message .= 'Номер машины: ' . booking_html($carNumber !== '' ? $carNumber : 'не указан') . '<br>';
if ($comment !== '') {
    $message .= 'Сообщение: ' . nl2br(booking_html($comment)) . '<br>';
}

$to = 'chalovmirror@gmail.com, Continent-marina@mail.ru';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Pirita Pesula <no-reply@pirita-pesula.ee>' . "\r\n";

if (!mail($to, $subject, $message, $headers)) {
    http_response_code(500);
    exit('Не удалось отправить заявку. Позвоните нам по телефону +372 5391 8434.');
}

$_SESSION['booking_last_sent_at'] = time();
echo 'Заявка принята! Мы свяжемся с вами для подтверждения времени.';
