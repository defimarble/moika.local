<?php
if (!isset($service) || !is_array($service)) {
    http_response_code(500);
    exit('Service configuration is missing.');
}

include_once('elements/top-page.php');
?>
    <title><?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8'); ?>">
<?php
$seoTitle = $service['title'];
$seoDescription = $service['description'];
$seoImage = isset($service['sections']) ? $service['sections'][0]['image'] : $service['image'];
include_once('elements/header.php');
?>

<div id="main-content">
    <div id="content">
        <h1 class="page-title"><span><?php echo htmlspecialchars($service['heading'], ENT_QUOTES, 'UTF-8'); ?></span></h1>

        <div class="usl-list">
            <p style="max-width: 970px; font-size: 14px; color: #3d3d3d; margin-right: auto;">
                <?php echo $service['intro']; ?>
            </p>
            <div class="clear"></div>
        </div>

        <?php
        $sections = isset($service['sections']) ? $service['sections'] : [[
            'title' => $service['section_title'],
            'image' => $service['image'],
            'image_alt' => $service['image_alt'],
            'content' => $service['content']
        ]];
        foreach ($sections as $index => $section):
        $imageSize = @getimagesize($section['image']);
        ?>
        <div class="usl-list service-section">
            <div class="line"></div>
            <div class="title"><?php echo htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="left">
                <div class="img">
                    <img loading="lazy" decoding="async" src="<?php echo htmlspecialchars($section['image'], ENT_QUOTES, 'UTF-8'); ?>"
                         <?php if ($imageSize): ?>width="<?php echo $imageSize[0]; ?>" height="<?php echo $imageSize[1]; ?>"<?php endif; ?>
                         alt="<?php echo htmlspecialchars($section['image_alt'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <?php if ($index === count($sections) - 1): ?>
                <div class="bottom-block">
                    <div class="price"><?php echo htmlspecialchars($service['price'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="bron-bt" onclick="AlexApp.popup('Детейлинг')">Заказать</div>
                </div>
                <?php endif; ?>
            </div>
            <div class="right">
                <?php echo $section['content']; ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php endforeach; ?>

        <?php if (!empty($service['after_sections'])): ?>
        <div class="usl-list service-conclusion">
            <?php echo $service['after_sections']; ?>
        </div>
        <div class="clear"></div>
        <?php endif; ?>
    </div>
</div>

<?php include_once('elements/footer.php'); ?>
