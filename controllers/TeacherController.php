<?php

namespace app\controllers;

use app\models\forms\SearchFormTeacher;
use app\models\Teacher;

class TeacherController extends MainController
{
    public function __construct()
    {
        // Initial restricted areas
        parent::__construct(Teacher::class, SearchFormTeacher::class);
        $this->setContentView('teacher');
    }
}