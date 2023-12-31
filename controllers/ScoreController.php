<?php

namespace app\controllers;

use app\models\forms\SearchFormScore;
use app\models\forms\SearchFormStudent;
use app\models\forms\SearchFormTeacher;
use app\models\Score;
use app\models\Student;
use app\models\Teacher;

class ScoreController extends MainController
{
    public function __construct()
    {
        // Initial restricted areas
        parent::__construct(Score::class, SearchFormScore::class);
        $this->setContentView('score');
    }
}