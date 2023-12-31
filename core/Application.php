<?php

namespace app\core;

use app\core\db\Database;
use app\models\Admin;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?Controller $controller = null;
    public string $layout = 'main';
    public ?Admin $admin;
    public ?string $loginTime;
    public View $view;
    public string $userClass;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view = new View();
        $primaryValue = $this->session->get('admin');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->admin = $this->userClass::findOne([$primaryKey => $primaryValue]);
            $this->loginTime = $this->session->get('loginTime');
        } else {
            $this->admin = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->admin;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            $this->controller->setContentView('');
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
//            $this->response->redirect('/login');
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(Admin $admin)
    {
        $this->admin = $admin;
        $primaryKey = $admin->primaryKey();
        $primaryValue = $admin->{$primaryKey};
        $this->session->set('admin', $primaryValue);
        $loginTime = "[".date('Y-m-d H:i')."]";
        $this->session->set('loginTime', $loginTime);
        return true;
    }

    public function logout()
    {
        $this->admin = null;
        $this->session->remove('admin');
    }
}