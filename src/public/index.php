<?php

require_once __DIR__ . '/app/init.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(COOKIES_LIFETIME);
    session_start();
}

$app = new App();

?>