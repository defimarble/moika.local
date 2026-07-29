<?php
require_once __DIR__ . '/elements/i18n.php';

$language = isset($siteLanguage) ? $siteLanguage : '';
$page = isset($localizedPage) ? basename($localizedPage) : '';

if (!in_array($language, array('en', 'et'), true)) {
    http_response_code(404);
    exit('Page not found.');
}

if (!in_array($page, site_public_pages(), true)) {
    $page = '404.php';
    http_response_code(404);
}

$siteLanguage = $language;
$localizedPage = $page;
chdir(__DIR__);
ob_start('site_localize_html');
require __DIR__ . '/' . $page;
ob_end_flush();
