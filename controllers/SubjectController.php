<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\helpers\UploadHelper;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Admin;
use app\models\LoginForm;
use app\models\ResetForm;
use app\models\ResetRequestForm;
use app\models\SearchFormSubject;
use app\models\Subject;
use app\models\User;


class SubjectController extends Controller
{
    public function __construct()
    {
        // Initial restricted areas
        $this->registerMiddleware(new AuthMiddleware(['register', 'confirm']));
        $this->setContentView('subject');
    }

    public function register(Request $request, Response $response)
    {
        $subject = new Subject();
        if ($request->isPost()) {
            $subject->loadData($request->getBody());
            $edit = $request->getBody()['edit'] ?? '';
            if ($edit === '') {
                UploadHelper::uploadFile($subject, 'avatar', Application::$ROOT_DIR . '/public/web/avatar', $request);
                if ($subject->validate()) {
                    $subject->avatar = basename($subject->avatar);
                    return $this->render('confirm', ['model' => $subject]);
                }
            }
            return $this->render('register', ['model' => $subject]);
        }
        return $this->render('register', ['model' => $subject]);
    }

    public function confirm(Request $request, Response $response)
    {
        $subject = new Subject();
        if ($request->isPost()) {
            $subject->loadData($request->getBody());
            $edit = $request->getBody()['edit'];
            if ($edit != 'true') {
                if ($subject->validate() && $subject->save())
                {
                    return $this->render('complete', ['model' => $subject]);
                }
            }
            $response->redirect('/registerSubject');
        }
        $response->redirect('/registerSubject');
        exit;
    }

    public function search(Request $request, Response $response)
    {
        $subjectForm = new SearchFormSubject();
        if ($request->isPost()) {
            $subjectForm->loadData($request->getBody());
            $items = $subjectForm->search($subjectForm->getNameSearchKey(), $subjectForm->getSearchValue());
            return $this->render('search', ['model' => $subjectForm, 'items' => $items]);
        }
        return $this->render('search', ['model' => $subjectForm, 'items' => []]);
    }
}