<?php
include 'autoloader.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$core = new \base\core\Core();
$app = new \base\Application([
    'db' => [
        'className' => \base\DBConnection::class,
        'properties' => [
            'host' => "localhost",
            'db_name' => 'image_upload',
            'username' => 'root',
            'password' => 'not_root'
        ]
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
        'dependencies' => [
            'userRepository' => \repositories\UserRepository::class
        ],
    ],
    'requestComponent' => [
        'className' => \base\RequestComponent::class
    ]

]);
$core::$app = $app;
$core::$app->run();
