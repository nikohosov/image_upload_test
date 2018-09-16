<?php
include 'autoloader.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$core = new \base\core\Core();
$app = new \base\Application([
    'db' => [
        'className' => \base\DBConnection::class,
        'properties' => ['te1st' => "test_prop"]
    ]
]);
$core::$app = $app;
$core::$app->run();
