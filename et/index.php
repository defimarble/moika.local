<?php
$siteLanguage = 'et';
$localizedPage = isset($_GET['page']) ? basename($_GET['page']) : 'index.php';
require dirname(__DIR__) . '/localized-page.php';
