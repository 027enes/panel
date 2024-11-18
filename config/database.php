<?php
    // .env dosyasını manuel olarak oku
    $envFile = __DIR__ . '/../../.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }
    }

    define('CONFIG', [
        'database' => 'mysql:dbname=' . $_ENV['DATABASE_NAME'] . ';host=' . $_ENV['DATABASE_HOST'] . ';port=' . $_ENV['DATABASE_PORT'],
        'database_username' => $_ENV['DATABASE_USER'],
        'database_password' => $_ENV['DATABASE_PASSWORD']
    ]);
?>