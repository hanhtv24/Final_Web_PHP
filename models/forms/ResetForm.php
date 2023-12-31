<?php

namespace app\models\forms;

use app\core\Model;
use app\models\Admin;

class ResetForm extends Model
{
    public string $login_id = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }

    public function labels() : array
    {
        return [
            'login_id' => 'Login ID',
        ];
    }

    public function resetPassword()
    {
        $admin = Admin::findOne(['login_id' => $this->login_id]);
        $admin->reset_password_token = "";
        $admin->password = password_hash($this->password, PASSWORD_DEFAULT);
        $admin->update(['reset_password_token', 'password'], ['login_id' => $this->login_id]);
        return true;
    }
}