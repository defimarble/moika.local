<?php
require_once __DIR__ . '/booking-security.php';
require_once __DIR__ . '/i18n.php';
booking_start_session();
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(site_language(), ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <script>
        (function () {
            var theme;
            try { theme = localStorage.getItem('site-theme'); } catch (e) {}
            if (theme !== 'light' && theme !== 'dark') {
                theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', theme);
        }());
    </script>
    <link rel="icon" type="image/x-icon" href="image/favicon.ico"/>
    <link rel="preload" href="fonts/open_sans_regular.woff2" as="font" type="font/woff2" crossorigin>
    <link href="css/main.css?v=<?php echo (int) @filemtime(__DIR__ . '/../css/main.css'); ?>" type="text/css" rel="stylesheet">
    <link href="css/theme.css?v=<?php echo (int) @filemtime(__DIR__ . '/../css/theme.css'); ?>" type="text/css" rel="stylesheet">
    <script type='text/javascript' src='js/jquery-2.1.3.js'></script>
    <script type='text/javascript' src='js/jquery-ui-1.9.2.custom.min.js'></script>
    <script type='text/javascript' src='js/jquery.bxslider.min.js'></script>
    <script type='text/javascript' src='js/jquery.formstyler.min.js'></script>
    <script type='text/javascript' src='js/jquery.scrollTo.js'></script>
    <script type='text/javascript' src='js/jquery.validate.min.js'></script>
    <script>window.siteLanguage = <?php echo json_encode(site_language()); ?>;</script>
    <script type='text/javascript' src='js/script.js'></script>
    <script type='text/javascript' src='js/theme.js' defer></script>
