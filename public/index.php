<?php
use app\controllers\SiteController;
use app\core\Application;
use app\controllers\AuthController;
use app\controllers\SubjectController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\Admin::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->get('/resetRequest', [AuthController::class, 'resetRequest']);
$app->router->post('/resetRequest', [AuthController::class, 'resetRequest']);
$app->router->get('/reset', [AuthController::class, 'reset']);
$app->router->post('/reset', [AuthController::class, 'reset']);


$app->router->get('/registerSubject', [SubjectController::class, 'register']);
$app->router->post('/registerSubject', [SubjectController::class, 'register']);

$app->router->get('/confirmSubject', [SubjectController::class, 'confirm']);
$app->router->post('/confirmSubject', [SubjectController::class, 'confirm']);

$app->router->get('/searchSubject', [SubjectController::class, 'search']);
$app->router->post('/searchSubject', [SubjectController::class, 'search']);

$app->run();