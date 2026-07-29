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
