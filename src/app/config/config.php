<?php

// URL
define('BASE_URL', 'http://localhost:8080/public');
define('STORAGE_URL', 'http://localhost:8080/storage');

// Database
define('HOST', $_ENV['MYSQL_HOST']);
define('DB_NAME', $_ENV['MYSQL_DATABASE']);
define('USER', $_ENV['MYSQL_USER'] ?? 'root');
define('PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('PORT', $_ENV['MYSQL_PORT'] ?? 3306);
define('ROWS_PER_PAGE', 10);

// File
define('MAX_FILE_SIZE', 10 * 1024 * 1024);
define('ALLOWED_IMAGES', ['image/jpeg' => '.jpeg', 'image/png' => '.png']);

// Session
define('COOKIES_LIFETIME', 60 * 60 * 24);
define('SESSION_EXPIRATION_TIME', 60 * 60 * 24);
define('SESSION_REGENERATE_TIME', 30 * 60);

// Debounce
define('DEBOUNCE_TIMEOUT', 500);