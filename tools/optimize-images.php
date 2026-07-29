<?php

$directories = ['image', 'slider', 'gallery'];
$maxWidth = 1600;
$quality = 82;
$converted = 0;

foreach ($directories as $directory) {
    $files = array_merge(
        glob($directory . DIRECTORY_SEPARATOR . '*.jpg'),
        glob($directory . DIRECTORY_SEPARATOR . '*.jpeg'),
        glob($directory . DIRECTORY_SEPARATOR . '*.JPG'),
        glob($directory . DIRECTORY_SEPARATOR . '*.JPEG')
    );

    foreach ($files as $file) {
        $source = @imagecreatefromjpeg($file);
        if (!$source) {
            continue;
        }

        $width = imagesx($source);
        $height = imagesy($source);

        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round($height * $maxWidth / $width);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $resized,
                $source,
                0,
                0,
                0,
                0,
                $newWidth,
                $newHeight,
                $width,
                $height
            );
            imagedestroy($source);
            $source = $resized;
        }

        $output = preg_replace('/\.jpe?g$/i', '.webp', $file);
        if (imagewebp($source, $output, $quality)) {
            $converted++;
        }
        imagedestroy($source);
    }
}

echo 'Converted images: ' . $converted . PHP_EOL;
