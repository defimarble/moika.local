<?php

function site_supported_languages()
{
    return array('ru', 'en', 'et');
}

function site_language()
{
    $language = isset($GLOBALS['siteLanguage']) ? $GLOBALS['siteLanguage'] : 'ru';
    return in_array($language, site_supported_languages(), true) ? $language : 'ru';
}

function site_public_pages()
{
    return array(
        'index.php',
        'usl.php',
        'moika_avto_snaruzhi.php',
        'chistka_salona_avto.php',
        'deteiling_tallinn.php',
        'polirovka_kuzova.php',
        'polirovka_far.php',
        'himchistka_salona.php',
        'himchistka_dvigatelya.php',
        'polnaya_ochistka_avtomobilya.php',
        'pokrytie_voskom.php',
        'pokrytie_keramikoy.php',
        'zashchitnaya_plenka.php',
        'deteiling_yacht_tallinn.php',
        'avtomoika_korporativnym_klientam_tallinn.php',
        'price.php',
        'gallery.php',
        '404.php'
    );
}

function site_current_page()
{
    if (!empty($GLOBALS['localizedPage'])) {
        return basename($GLOBALS['localizedPage']);
    }

    $path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH);
    $page = basename($path);
    return $page !== '' ? $page : 'index.php';
}

function site_language_url($language, $page = null)
{
    $page = $page ?: site_current_page();
    if (!in_array($page, site_public_pages(), true)) {
        $page = 'index.php';
    }

    if ($language === 'ru') {
        return '/' . $page;
    }

    return '/' . $language . '/' . $page;
}

function site_translation_map($language)
{
    if ($language === 'ru') {
        return array();
    }

    $generatedFile = __DIR__ . '/../languages/' . $language . '.generated.php';
    $curatedFile = __DIR__ . '/../languages/' . $language . '.php';
    $generated = is_file($generatedFile) ? require $generatedFile : array();
    $curated = is_file($curatedFile) ? require $curatedFile : array();

    return array_merge($generated, $curated);
}

function site_localize_html($html)
{
    $language = site_language();
    if ($language === 'ru') {
        return $html;
    }

    $translations = site_translation_map($language);

    if (class_exists('DOMDocument')) {
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML($html);
        libxml_clear_errors();
        $xpath = new DOMXPath($document);

        foreach ($xpath->query('//text()[not(ancestor::script) and not(ancestor::style)]') as $node) {
            $source = site_normalize_translation_key($node->nodeValue);
            if ($source !== '' && isset($translations[$source])) {
                $node->nodeValue = $translations[$source];
            }
        }

        foreach (array('placeholder', 'alt', 'title', 'content', 'data-title', 'data-copy') as $attribute) {
            foreach ($xpath->query('//*[@' . $attribute . ']') as $node) {
                $source = site_normalize_translation_key($node->getAttribute($attribute));
                if ($source !== '' && isset($translations[$source])) {
                    $node->setAttribute($attribute, $translations[$source]);
                }
            }
        }

        foreach ($xpath->query('//input[@type="submit" and @value]') as $node) {
            $source = site_normalize_translation_key($node->getAttribute('value'));
            if ($source !== '' && isset($translations[$source])) {
                $node->setAttribute('value', $translations[$source]);
            }
        }

        foreach ($xpath->query('//script') as $node) {
            $script = $node->nodeValue;
            $protected = array();
            foreach (site_booking_service_values() as $index => $service) {
                $token = '__BOOKING_SERVICE_' . $index . '__';
                if (strpos($script, $service) !== false) {
                    $script = str_replace($service, $token, $script);
                    $protected[$token] = $service;
                }
            }
            $node->nodeValue = strtr(strtr($script, $translations), $protected);
        }

        $html = $document->saveHTML();
    }
    $prefix = '/' . $language . '/';

    $html = preg_replace_callback(
        '~\b(href|action)="([^"]*)"~i',
        function ($matches) use ($prefix) {
            $attribute = $matches[1];
            $url = $matches[2];

            if ($url === '/' || $url === 'index.php') {
                return $attribute . '="' . $prefix . 'index.php"';
            }

            if (preg_match('~^(?:https?:|tel:|mailto:|#|javascript:|/)~i', $url)) {
                return $matches[0];
            }

            $parts = explode('#', $url, 2);
            $path = ltrim($parts[0], '/');
            $fragment = isset($parts[1]) ? '#' . $parts[1] : '';

            if (preg_match('~^[a-z0-9_-]+\.php$~i', $path)) {
                return $attribute . '="' . $prefix . $path . $fragment . '"';
            }

            return $attribute . '="/' . $path . $fragment . '"';
        },
        $html
    );

    $html = preg_replace_callback(
        '~\bsrc="(?!https?:|//|data:|/)([^"]+)"~i',
        function ($matches) {
            return 'src="/' . ltrim($matches[1], '/') . '"';
        },
        $html
    );

    return preg_replace('~<html(?:\s+lang="[^"]*")?>~i', '<html lang="' . $language . '">', $html, 1);
}

function site_booking_service_values()
{
    return array(
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
        'Детейлинг яхты',
        'Мойка',
        'Детейлинг',
        'Детейлинг Яхты'
    );
}

function site_normalize_translation_key($value)
{
    return preg_replace('/\s+/u', ' ', trim(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
}

function site_hreflang_links()
{
    $page = site_current_page();
    $links = array();
    $host = preg_replace('/[^a-z0-9.:-]/i', '', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'moika.local');
    $secure = !empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off';
    $origin = ($secure ? 'https' : 'http') . '://' . $host;

    foreach (array('ru' => 'ru', 'en' => 'en', 'et' => 'et') as $language => $hreflang) {
        $links[] = '<link rel="alternate" hreflang="' . $hreflang . '" href="' .
            htmlspecialchars($origin . site_language_url($language, $page), ENT_QUOTES, 'UTF-8') . '">';
    }
    $links[] = '<link rel="alternate" hreflang="x-default" href="' .
        htmlspecialchars($origin . site_language_url('ru', $page), ENT_QUOTES, 'UTF-8') . '">';

    return implode("\n    ", $links);
}
