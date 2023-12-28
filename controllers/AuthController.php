<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Admin;
use app\models\AdminLoginLogs;
use app\models\LoginForm;
use app\models\ResetForm;
use app\models\ResetRequestForm;
use app\models\User;


class AuthController extends Controller
{
    public function __construct()
    {
        // Initial restricted areas
        $this->registerMiddleware(new AuthMiddleware(['profile', 'reset']));
    }

    public function register(Request $request, Response $response)
    {
        $admin = new Admin();
        if ($request->isPost()) {
            $admin->loadData($request->getBody());
            if ($admin->validate() && $admin->save())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
                exit;
            }
            $this->setLayout('auth');
            $this->setContentView('admin');
            return $this->render('register', ['model' => $admin]);
        }
        $this->setLayout('auth');
        $this->setContentView('admin');
        return $this->render('register', ['model' => $admin]);
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        $this->setContentView('admin');
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
        $this->setContentView('admin');
        return $this->render('resetRequest', [
            'model' => $resetRequest
        ]);
    }

    public function reset(Request $request, Response $response)
    {
        $admins = Admin::findAll(['reset_password_token' => ''], '<>');
        $resetForm = new ResetForm();
        if ($request->isPost()) {
            $resetForm->loadData($request->getBody());
            if ($resetForm->validate() && $resetForm->resetPassword()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        $this->setContentView('admin');
        return $this->render('reset', [
            'model' => $resetForm,
            'admins' => $admins,
        ]);
    }
}