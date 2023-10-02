<?php

require_once __DIR__ . '/../app/init.php';

if(session_status() == PHP_SESSION_ACTIVE)
{
    $current_time = time();

    if($current_time - $_SESSION['updated_at'] > SESSION_REGENERATE_TIME)
    {
        session_regenerate_id(true);
        $_SESSION['updated_at'] = $current_time;

        unset($_SESSION['csrf_token']);
    }

    if($current_time - $_SESSION['created_at'] > SESSION_EXPIRATION_TIME)
    {
        session_unset();
        session_destroy();
    }
}

if(session_status() == PHP_SESSION_NONE)
{
    session_set_cookie_params(COOKIES_LIFETIME);
    session_start();

    $_SESSION['created_at'] = time();
    $_SESSION['updated_at'] = time();
}

$app = new App();