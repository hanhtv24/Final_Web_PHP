<?php

use app\controllers\ScoreController;
use app\controllers\SiteController;
use app\controllers\StudentController;
use app\controllers\TeacherController;
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

$app->router->get('/updateSubject', [SubjectController::class, 'update']);
$app->router->post('/updateSubject', [SubjectController::class, 'update']);

$app->router->get('/confirmEditSubject', [SubjectController::class, 'confirmEdit']);
$app->router->post('/confirmEditSubject', [SubjectController::class, 'confirmEdit']);
$app->router->get('/deleteSubject', [SubjectController::class, 'delete']);


$app->router->get('/registerStudent', [StudentController::class, 'register']);
$app->router->post('/registerStudent', [StudentController::class, 'register']);

$app->router->get('/confirmStudent', [StudentController::class, 'confirm']);
$app->router->post('/confirmStudent', [StudentController::class, 'confirm']);

$app->router->get('/searchStudent', [StudentController::class, 'search']);
$app->router->post('/searchStudent', [StudentController::class, 'search']);

$app->router->get('/updateStudent', [StudentController::class, 'update']);
$app->router->post('/updateStudent', [StudentController::class, 'update']);

$app->router->get('/confirmEditStudent', [StudentController::class, 'confirmEdit']);
$app->router->post('/confirmEditStudent', [StudentController::class, 'confirmEdit']);
$app->router->get('/deleteStudent', [StudentController::class, 'delete']);

$app->router->get('/registerTeacher', [TeacherController::class, 'register']);
$app->router->post('/registerTeacher', [TeacherController::class, 'register']);

$app->router->get('/confirmTeacher', [TeacherController::class, 'confirm']);
$app->router->post('/confirmTeacher', [TeacherController::class, 'confirm']);

$app->router->get('/searchTeacher', [TeacherController::class, 'search']);
$app->router->post('/searchTeacher', [TeacherController::class, 'search']);

$app->router->get('/updateTeacher', [TeacherController::class, 'update']);
$app->router->post('/updateTeacher', [TeacherController::class, 'update']);

$app->router->get('/confirmEditTeacher', [TeacherController::class, 'confirmEdit']);
$app->router->post('/confirmEditTeacher', [TeacherController::class, 'confirmEdit']);
$app->router->get('/deleteTeacher', [TeacherController::class, 'delete']);

$app->router->get('/registerScore', [ScoreController::class, 'register']);
$app->router->post('/registerScore', [ScoreController::class, 'register']);

$app->router->get('/confirmScore', [ScoreController::class, 'confirm']);
$app->router->post('/confirmScore', [ScoreController::class, 'confirm']);

$app->router->get('/searchScore', [ScoreController::class, 'search']);
$app->router->post('/searchScore', [ScoreController::class, 'search']);

$app->router->get('/updateScore', [ScoreController::class, 'update']);
$app->router->post('/updateScore', [ScoreController::class, 'update']);

$app->router->get('/confirmEditScore', [ScoreController::class, 'confirmEdit']);
$app->router->post('/confirmEditScore', [ScoreController::class, 'confirmEdit']);
$app->router->get('/deleteScore', [ScoreController::class, 'delete']);

$app->run();