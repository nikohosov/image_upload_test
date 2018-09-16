<?php
include 'autoloader.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$core = new \base\core\Core();
$app = new \base\Application([
    'db' => [
        'className' => \base\DBConnection::class,
        'properties' => ['test' => "test_prop"]
    ],
    'urlResolver' => [
        'className' => \base\SimpleUrlResolver::class,
        'properties' => [
            'routesMap' => [
                'upload-image' => [
                    'controller' => \controllers\ImageController::class,
                    'action' => 'upload'
                ],
                'search-image' => [
                    'controller' => \controllers\ImageController::class,
                    'action' => 'search'
                ]
            ]
        ]
    ],
    'authorizeComponent' => [
        'className' => \base\AuthorizeComponent::class,
        'properties' => [],
    ],
    'requestComponent' => [
        'className' => \base\RequestComponent::class
    ]

]);
$core::$app = $app;
$core::$app->run();
