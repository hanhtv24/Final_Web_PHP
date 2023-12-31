<?php

namespace app\models\forms;

use app\core\Model;
use app\models\Admin;

class ResetRequestForm extends Model
{
    public string $login_id = '';

    public function rules(): array
    {
        return [
             'login_id' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 16]]
        ];
    }

    public function labels() : array
    {
        return [
            'login_id' => 'Login ID',
        ];
    }

    public function sendRequest()
    {
        $admin = Admin::findOne(['login_id' => $this->login_id]);
        if (!$admin) {
            $this->addError('login_id', 'Login id does not exist in system');
            return false;
        }
        $admin->reset_password_token = microtime(true);
        $admin->update(['reset_password_token'], ['login_id' => $this->login_id]);
        return true;
    }
}