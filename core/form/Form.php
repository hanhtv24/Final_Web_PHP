<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action, $method, string $id = '')
    {
        if ($id === '') {
            echo sprintf('<form action="%s" enctype="multipart/form-data" method="%s">', $action, $method);
        }
        echo sprintf('<form action="%s" id = "%s" enctype="multipart/form-data" method="%s">', $action, $id, $method);
        return new Form();
    }
    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute, $select_value = [])
    {
        return new InputField($model, $attribute, $select_value);
    }


}