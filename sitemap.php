<?php
header('Content-Type: application/xml; charset=UTF-8');

$host = preg_replace('/[^a-z0-9.:-]/i', '', $_SERVER['HTTP_HOST'] ?? 'moika.local');
$isHttps = !empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off';
$baseUrl = ($isHttps ? 'https' : 'http') . '://' . $host . '/';
$pages = [
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
    'gallery.php'
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php
$languages = ['ru', 'en', 'et'];
foreach ($pages as $page):
    foreach ($languages as $language):
        $path = $language === 'ru'
            ? ($page === 'index.php' ? '' : $page)
            : $language . '/' . $page;
?>
    <url>
        <loc><?php echo htmlspecialchars($baseUrl . $path, ENT_XML1, 'UTF-8'); ?></loc>
        <?php foreach ($languages as $alternateLanguage):
            $alternatePath = $alternateLanguage === 'ru'
                ? ($page === 'index.php' ? '' : $page)
                : $alternateLanguage . '/' . $page;
        ?>
        <xhtml:link rel="alternate"
                    hreflang="<?php echo $alternateLanguage; ?>"
                    href="<?php echo htmlspecialchars($baseUrl . $alternatePath, ENT_XML1, 'UTF-8'); ?>"/>
        <?php endforeach; ?>
        <xhtml:link rel="alternate"
                    hreflang="x-default"
                    href="<?php echo htmlspecialchars($baseUrl . ($page === 'index.php' ? '' : $page), ENT_XML1, 'UTF-8'); ?>"/>
    </url>
<?php
    endforeach;
endforeach;
?>
</urlset>
