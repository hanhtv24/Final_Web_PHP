<?php

namespace app\core;

use app\core\db\Database;
use app\core\exception\TimeOutException;
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
    public ?string $loginTime = '';

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
        $this->setAdminAndTime();
    }

    public function setAdminAndTime()
    {
        $primaryValue = $this->session->get('admin');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->admin = $this->userClass::findOne([$primaryKey => $primaryValue]);
            $this->loginTime = date('Y-m-d H:i:s');
            if (!$this->checkUserActivityTimeout()) {
                $this->session->set('lastActivityTime', time());
            }
        } else {
            $this->admin = null;
        }
    }

    public function checkUserActivityTimeout($timeoutInSeconds = 30)
    {
        $lastActivityTime = $this->session->get('lastActivityTime');
        if ($lastActivityTime !== null && (time() - $lastActivityTime) > $timeoutInSeconds) {
            return true;
        } else {
            return false;
        }
    }

    public static function isGuest()
    {
        return !self::$app->admin;
    }

    public function run()
    {
        try {
            if ($this->session->get('lastActivityTime') != '' && $this->checkUserActivityTimeout()) {
                $this->logout();
                throw new TimeOutException();
            }
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            $this->controller = new Controller();
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
        $this->session->set('lastActivityTime', time());
        return true;
    }

    public function logout()
    {
        $this->admin = null;
        $this->session->remove('admin');
        $this->session->remove('lastActivityTime');
    }
}