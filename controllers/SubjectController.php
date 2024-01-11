<?php

namespace app\controllers;

use app\core\middlewares\AuthMiddleware;
use app\models\forms\SearchFormSubject;
use app\models\Subject;

class SubjectController extends MainController
{
    public function __construct()
    {
        // Initial restricted areas
        parent::__construct(Subject::class, SearchFormSubject::class);
        $this->registerMiddleware(new AuthMiddleware(['register', 'confirm', 'complete', 'search', '/registerSubject']));
        $this->setContentView('subject');
    }
}