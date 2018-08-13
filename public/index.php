<?php
// Enable PSR autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Load dotenv?
if (file_exists(__DIR__ . '/../.env')) {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
}

// Create app
$app = new \Slim\App;

// Enable routes
require_once __DIR__ . '/../app/routes.php';

// Run application
try {
    $app->run();
} catch (Exception $e) {
    error_log($e->getMessage() . "\n");
}
