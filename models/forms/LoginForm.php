<?php

namespace app\models\forms;

use app\core\Application;
use app\core\Model;
use app\models\Admin;

class LoginForm extends Model
{
    public string $login_id = '';
    public string $password = '';

    public function rules(): array
    {
        return [
             'login_id' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
             'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }

    public function labels() : array
    {
        return [
            'login_id' => 'Login ID',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $admin = Admin::findOne(['login_id' => $this->login_id]);
        if (!$admin) {
            $this->addError('login_id', 'Login id does not exist in system');
            return false;
        }
        if (!password_verify($this->password, $admin->password)) {
            $this->addError('password', 'Login id and password is incorrect');
            return false;
        }
        return Application::$app->login($admin);
    }
}