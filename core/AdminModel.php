<?php

namespace app\core;

use app\core\db\DbModel;

abstract class AdminModel extends DbModel
{
    abstract public function getDisplayName() : string;
}