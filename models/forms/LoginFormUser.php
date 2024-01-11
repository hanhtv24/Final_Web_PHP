<?php

namespace app\models\forms;

use app\core\Application;
use app\core\Model;
use app\models\Admin;
use app\models\User;

class LoginFormUser extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
             'email' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
             'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }

    public function labels() : array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'Email does not exist in system');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Email and password is incorrect');
            return false;
        }
        return Application::$app->login($user);
    }
}