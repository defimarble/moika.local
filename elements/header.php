<?php
$seoPages = [
    'index.php' => [
        'title' => 'Автомойка Pirita Pesula',
        'description' => 'Профессиональная ручная автомойка и детейлинг автомобилей в Таллинне: наружная мойка, химчистка салона, полировка и защитные покрытия.'
    ],
    'price.php' => [
        'title' => 'Цены на услуги автомойки - Pirita Pesula',
        'description' => 'Полный прайс-лист Pirita Pesula на ручную мойку, химчистку салона, полировку, керамику, воск и другие услуги детейлинга в Таллинне.'
    ],
    'gallery.php' => [
        'title' => 'Фотогалерея автомойки - Pirita Pesula',
        'description' => 'Фотографии работ Pirita Pesula: ручная мойка, химчистка салона, полировка кузова и профессиональный детейлинг автомобилей в Таллинне.'
    ],
    'moika_avto_snaruzhi.php' => [
        'title' => 'Наружная мойка автомобиля - Pirita Pesula',
        'description' => 'Профессиональная наружная ручная мойка автомобиля в Таллинне с безопасной автохимией, очисткой кузова, дисков, арок и стёкол.'
    ],
    'chistka_salona_avto.php' => [
        'title' => 'Чистка салона автомобиля - Pirita Pesula',
        'description' => 'Профессиональная чистка салона автомобиля в Таллинне: пылесос, очистка пластика, стёкол, текстиля и уход за кожаными поверхностями.'
    ],
    'deteiling_tallinn.php' => [
        'title' => 'Детейлинг в Таллинне - Pirita Pesula',
        'description' => 'Профессиональный детейлинг автомобилей в Таллинне: полировка, химчистка, керамика, воск и защитная полиуретановая плёнка.'
    ],
    'polirovka_kuzova.php' => [
        'title' => 'Полировка кузова автомобиля - Pirita Pesula',
        'description' => 'Профессиональная полировка кузова автомобиля в Таллинне: удаление мелких дефектов, восстановление блеска и подготовка к защитному покрытию.'
    ],
    'deteiling_yacht_tallinn.php' => [
        'title' => 'Детейлинг яхт в Таллинне - Pirita Pesula',
        'description' => 'Профессиональный детейлинг и обслуживание яхт в Таллинне: мойка, полировка, защита корпуса, палубы и металлических элементов.'
    ],
    'avtomoika_korporativnym_klientam_tallinn.php' => [
        'title' => 'Автомойка для корпоративных клиентов - Pirita Pesula',
        'description' => 'Корпоративное обслуживание автопарков в Таллинне: ручная мойка, чистка салона и детейлинг автомобилей с оплатой по счёту.'
    ],
    'usl.php' => [
        'title' => 'Услуги автомойки - Pirita Pesula',
        'description' => 'Услуги ручной автомойки Pirita Pesula в Таллинне: наружная мойка, чистка салона и комплексный уход за автомобилем.'
    ]
];
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'] ?? '/index.php', PHP_URL_PATH));
if ($currentPage === '') {
    $currentPage = 'index.php';
}
$seoTitle = $seoTitle ?? ($seoPages[$currentPage]['title'] ?? 'Pirita Pesula — автомойка и детейлинг в Таллинне');
$seoDescription = $seoDescription ?? ($seoPages[$currentPage]['description'] ?? 'Профессиональная ручная мойка автомобилей и детейлинг в Таллинне.');
$seoImage = $seoImage ?? 'image/logo.png';
$host = preg_replace('/[^a-z0-9.:-]/i', '', $_SERVER['HTTP_HOST'] ?? 'moika.local');
$isHttps = !empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off';
$scheme = $isHttps ? 'https' : 'http';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$canonicalUrl = $scheme . '://' . $host . ($requestPath ?: '/');
$absoluteImage = $scheme . '://' . $host . '/' . ltrim($seoImage, '/');
$localBusinessSchema = [
    '@context' => 'https://schema.org',
    '@type' => ['AutoWash', 'LocalBusiness'],
    'name' => 'Pirita Pesula',
    'url' => $scheme . '://' . $host . '/',
    'image' => $absoluteImage,
    'telephone' => '+37253918434',
    'email' => 'piritapesula@gmail.com',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Kalamehe tee 1a',
        'addressLocality' => 'Tallinn',
        'addressCountry' => 'EE'
    ],
    'openingHours' => 'Mo-Sa 09:00-20:00',
    'sameAs' => [
        'https://vk.com/piritapesula',
        'https://www.facebook.com/piritapesula/',
        'https://www.instagram.com/piritapesula/'
    ]
];
?>
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <?php echo site_hreflang_links(); ?>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?php echo site_language() === 'et' ? 'et_EE' : (site_language() === 'en' ? 'en_GB' : 'ru_RU'); ?>">
    <meta property="og:site_name" content="Pirita Pesula">
    <meta property="og:title" content="<?php echo htmlspecialchars($seoTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($absoluteImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json"><?php echo json_encode($localBusinessSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
</head>
<body>
<button class="theme-toggle" type="button" aria-label="Switch color theme" title="Switch color theme">
    <span class="theme-toggle__sun" aria-hidden="true">&#9728;</span>
    <span class="theme-toggle__moon" aria-hidden="true">&#9790;</span>
</button>
<div class="line" id="main"></div>
<div id="top-line">
    <div id="main-header">
        <div id="header">
            <a href="/" class="logo">
                <img src="image/logo.png" width="220" height="65" alt="Pirita Pesula">
            </a>
            <div class="right-block">
                <ul class="lang">
                    <li>
                        <a href="<?php echo htmlspecialchars(site_language_url('et'), ENT_QUOTES, 'UTF-8'); ?>"<?php if (site_language() === 'et'): ?> class="active"<?php endif; ?>>
                            EE
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo htmlspecialchars(site_language_url('ru'), ENT_QUOTES, 'UTF-8'); ?>"<?php if (site_language() === 'ru'): ?> class="active"<?php endif; ?>>
                            RU
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo htmlspecialchars(site_language_url('en'), ENT_QUOTES, 'UTF-8'); ?>"<?php if (site_language() === 'en'): ?> class="active"<?php endif; ?>>
                            ENG
                        </a>
                    </li>
                </ul>
                <div class="bron-bt" onclick="AlexApp.popup()">
                    ЗАБРОНИРОВАТЬ               
		</div>
                <ul class="contacts">
                    <li>
					<a href="index.php#contacts" style="font-size: 18px;">
                        Tallinn, Kalamehe tee, 1a
                    </a>
                    </li>
                    <li>
                        <a href="tel:+37253918434">
                            +372 5391 8434
                        </a>
                    </li>
                </ul>
                <ul class="mobile-menu">
                    <li class="mobile-menu-bt" role="button" tabindex="0" aria-label="Открыть меню">
                        &nbsp;
                    </li>
                    <li>
                        <a href="tel:+37253918434" aria-label="Позвонить">
                            &nbsp;
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div id="main-menu">
        <div id="menu">
            <ul class="menu">
                <li>
                    <a href="/" class="scroll">ГЛАВНАЯ</a>
                </li>
<!--				
                <li>
                    <a href="#preim" class="scroll">ПРЕИМУЩЕСТВА</a>
                </li>
-->				
                <li class="menu-item-has-children">
                    <a href="index.php#mainserv">УСЛУГИ</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="moika_avto_snaruzhi.php" class="scroll">Наружная мойка</a>
							
                        </li>
                        <li>
                            <a href="chistka_salona_avto.php" class="scroll">Чистка салона</a>
                        </li>
                        <li>
                            <a href="deteiling_tallinn.php" class="scroll">Детейлинг автомобилей</a>
                        </li>
						<li>
                            <a href="deteiling_yacht_tallinn.php" class="scroll">Обслуживание и детейлинг яхт</a>
                        </li>
						<li>
                            <a href="avtomoika_korporativnym_klientam_tallinn.php" class="scroll">Корпоративным клиентам</a>
                        </li>

                    </ul>
                </li>
				<li class="menu-item-has-children">
                    <a href="deteiling_tallinn.php">Детейлинг</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="polirovka_kuzova.php" class="scroll">Полировка кузова</a>
                        </li>
                        <li>
                            <a href="polirovka_far.php" class="scroll">Полировка и восстановление фар</a>
                        </li>
                        <li>
                            <a href="himchistka_salona.php" class="scroll">Химчистка салона</a>
                        </li>
                        <li>
                            <a href="himchistka_dvigatelya.php" class="scroll">Химчистка двигателя</a>
                        </li>
                        <li>
                            <a href="polnaya_ochistka_avtomobilya.php" class="scroll">Полная очистка автомобиля</a>
                        </li>
                        <li>
                            <a href="pokrytie_voskom.php" class="scroll">Покрытие воском</a>
                        </li>
                        <li>
                            <a href="pokrytie_keramikoy.php" class="scroll">Покрытие керамикой</a>
                        </li>
                        <li>
                            <a href="zashchitnaya_plenka.php" class="scroll">Покрытие защитной пленкой</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="price.php" class="scroll">
                        ПРАЙС               </a>
                </li>
                <li>
                    <a href="gallery.php">
                        ГАЛЕРЕЯ                  </a>
                </li>
                <li>
                    <a href="index.php#contacts" class="scroll">
                        КОНТАКТЫ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="tp"></div>
