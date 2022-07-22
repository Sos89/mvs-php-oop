<?php

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\ProductController;
use app\controllers\ReviewsController;
use app\controllers\SiteController;
use app\core\Application;


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/dashboard', [SiteController::class, 'dashboard']);
$app->router->post('/dashboard', [SiteController::class, 'dashboard']);
$app->router->get('/comment', [SiteController::class, 'comment']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/admin', [AdminController::class, 'index']);
$app->router->post('/create', [ProductController::class, 'insert']);
$app->router->post('/editProduct', [ProductController::class, 'editProduct']);
$app->router->get('/edit', [ProductController::class, 'edit']);
$app->router->get('/productDelete', [ProductController::class, 'delete']);

$app->router->get('/review', [ReviewsController::class, 'review']);
$app->router->get('/view', [ReviewsController::class, 'view']);
$app->router->post('/insert', [ReviewsController::class, 'insert']);



$app->run();
