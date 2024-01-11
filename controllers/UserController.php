<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\forms\LoginForm;
use app\models\forms\LoginFormUser;
use app\models\forms\ResetForm;
use app\models\forms\ResetRequestForm;
use app\models\User;


class UserController extends Controller
{
    public function __construct()
    {
        // Initial restricted areas
        $this->registerMiddleware(new AuthMiddleware(['profile', 'reset']));
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
                exit;
            }
            $this->setLayout('auth');
            $this->setContentView('user');
            return $this->render('register', ['model' => $user]);
        }
        $this->setLayout('auth');
        $this->setContentView('user');
        return $this->render('register', ['model' => $user]);
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginFormUser();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlash('success', 'LOGIN SUCCESSFUL');
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        $this->setContentView('user');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function resetRequest(Request $request, Response $response)
    {
        $resetRequest = new ResetRequestForm();
        if ($request->isPost()) {
            $resetRequest->loadData($request->getBody());
            if ($resetRequest->validate() && $resetRequest->sendRequest()) {
                $response->redirect('/login');
                return;
            }
        }
        $this->setLayout('auth');
        $this->setContentView('user');
        return $this->render('resetRequest', [
            'model' => $resetRequest
        ]);
    }

    public function reset(Request $request, Response $response)
    {
        $users = user::findAll(['reset_password_token' => ''], '<>');
        $resetForm = new ResetForm();
        if ($request->isPost()) {
            $resetForm->loadData($request->getBody());
            if ($resetForm->validate() && $resetForm->resetPassword()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        $this->setContentView('user');
        return $this->render('reset', [
            'model' => $resetForm,
            'users' => $users,
        ]);
    }
}