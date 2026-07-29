<?php
header('Content-Type: application/xml; charset=UTF-8');

$host = preg_replace('/[^a-z0-9.:-]/i', '', $_SERVER['HTTP_HOST'] ?? 'moika.local');
$isHttps = !empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off';
$baseUrl = ($isHttps ? 'https' : 'http') . '://' . $host . '/';
$pages = [
    '',
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
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $page): ?>
    <url>
        <loc><?php echo htmlspecialchars($baseUrl . $page, ENT_XML1, 'UTF-8'); ?></loc>
    </url>
<?php endforeach; ?>
</urlset>
