<?php

function booking_start_session()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $secure = !empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off';

    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params(array(
            'lifetime' => 0,
            'path' => '/',
            'secure' => $secure,
            'httponly' => true,
            'samesite' => 'Lax'
        ));
    } else {
        session_set_cookie_params(0, '/; samesite=Lax', '', $secure, true);
    }

    session_start();
}

function booking_csrf_token()
{
    booking_start_session();

    if (empty($_SESSION['booking_csrf_token'])) {
        $_SESSION['booking_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['booking_csrf_token'];
}

function booking_verify_csrf($token)
{
    booking_start_session();

    return is_string($token)
        && !empty($_SESSION['booking_csrf_token'])
        && hash_equals($_SESSION['booking_csrf_token'], $token);
}

function booking_sanitize_comment($value)
{
    $value = str_replace(array("\r\n", "\r"), "\n", $value);
    $unicodeCleaned = preg_replace(
        '/[\x{0080}-\x{009F}\x{061C}\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2060}-\x{206F}\x{FEFF}]/u',
        '',
        $value
    );
    if ($unicodeCleaned !== null) {
        $value = $unicodeCleaned;
    }

    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);
    return trim($value);
}

function booking_rate_limit($maxAttempts = 5, $windowSeconds = 600)
{
    $clientAddress = isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
    $clientKey = hash_hmac('sha256', $clientAddress, __FILE__);
    $storageDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR
        . 'var' . DIRECTORY_SEPARATOR . 'booking-rate';

    if (!is_dir($storageDirectory)
        && !@mkdir($storageDirectory, 0700, true)
        && !is_dir($storageDirectory)
    ) {
        return 0;
    }

    $storagePath = $storageDirectory . DIRECTORY_SEPARATOR . $clientKey . '.json';
    $handle = @fopen($storagePath, 'c+');
    if ($handle === false || !flock($handle, LOCK_EX)) {
        if (is_resource($handle)) {
            fclose($handle);
        }
        return 0;
    }

    $now = time();
    $contents = stream_get_contents($handle);
    $attempts = json_decode($contents ?: '[]', true);
    if (!is_array($attempts)) {
        $attempts = array();
    }

    $attempts = array_values(array_filter($attempts, function ($timestamp) use ($now, $windowSeconds) {
        return is_int($timestamp) && $timestamp > $now - $windowSeconds;
    }));

    $retryAfter = 0;
    if (count($attempts) >= $maxAttempts) {
        $retryAfter = max(1, (int) $attempts[0] + $windowSeconds - $now);
    } else {
        $attempts[] = $now;
        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, json_encode($attempts));
        fflush($handle);
        @chmod($storagePath, 0600);
    }

    flock($handle, LOCK_UN);
    fclose($handle);

    if (mt_rand(1, 100) === 1) {
        foreach ((array) glob($storageDirectory . DIRECTORY_SEPARATOR . '*.json') as $oldPath) {
            $modifiedAt = @filemtime($oldPath);
            if (is_file($oldPath) && $modifiedAt !== false && $modifiedAt < $now - $windowSeconds) {
                @unlink($oldPath);
            }
        }
    }

    return $retryAfter;
}
