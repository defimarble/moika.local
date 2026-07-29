<?php
http_response_code(404);
include_once('elements/top-page.php');
?>
    <title>Страница не найдена - Pirita Pesula</title>
    <meta name="description" content="Запрашиваемая страница не найдена. Перейдите на главную страницу автомойки Pirita Pesula.">
    <meta name="robots" content="noindex, follow">
<?php
$seoTitle = 'Страница не найдена - Pirita Pesula';
$seoDescription = 'Запрашиваемая страница не найдена. Перейдите на главную страницу автомойки Pirita Pesula.';
include_once('elements/header.php');
?>

<div id="main-content">
    <div id="content">
        <h1 class="page-title"><span>Страница не найдена</span></h1>
        <div class="usl-list">
            <p style="font-size: 16px; text-align: center;">
                Такой страницы не существует или её адрес изменился.
                <a href="/">Вернуться на главную страницу</a>.
            </p>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include_once('elements/footer.php'); ?>
