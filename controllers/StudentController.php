<?php

namespace app\controllers;

use app\models\forms\SearchFormStudent;
use app\models\Student;

class StudentController extends MainController
{
    public function __construct()
    {
        // Initial restricted areas
        parent::__construct(Student::class, SearchFormStudent::class);
        $this->setContentView('student');
    }
}