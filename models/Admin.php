<?php

namespace app\models;

use app\core\AdminModel;

class Admin extends AdminModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public string $login_id = '';
    public int $actived_flag = self::STATUS_INACTIVE;

    public string $password = '';
    public string $reset_password_token = '';
    public string $confirmPassword = '';
    public function tableName() : string
    {
        return 'admins';
    }
    public function save()
    {
        $this->actived_flag = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'login_id' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class], [self::RULE_MIN, 'min' => 4]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes() : array
    {
        return ['login_id', 'password', 'reset_password_token', 'actived_flag'];
    }
    public function labels() : array
    {
        return [
            'login_id' => 'Login ID',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
        ];
    }
    public function primaryKey(): string
    {
        return 'id';
    }
    public function getDisplayName(): string
    {
        return $this->login_id;
    }
}