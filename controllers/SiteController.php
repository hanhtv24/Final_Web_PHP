<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\forms\ContactForm;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['contact']));
    }

    public function home()
    {
        $params = [
          'name' => "Quang"
        ];
        return $this->render('home', $params);
    }
    public function contact(Request $request, Response $response)
    {
        $contactForm = new ContactForm();
        if ($request->isPost()) {
            $contactForm->loadData($request->getBody());
            if ($contactForm->validate() && $contactForm->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                $response->redirect('/contact');
                return;
            }
        }
        return $this->render('contact', ['model' => $contactForm]);
    }
}