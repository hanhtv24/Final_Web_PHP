<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    public string $name = '';
    public string $email = '';
    public string $role = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';
    public string $reset_password_token = '';
    public function tableName() : string
    {
        return 'users';
    }
    public function save()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'role' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 16]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes() : array
    {
        return ['name', 'email', 'password', 'status', 'reset_password_token', 'role'];
    }
    public function labels() : array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
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
        return $this->name;
    }

    public static function selectionValue()
    {
        return
            ['role' => ['001' => 'Admin', '002' => 'Teacher', '003' => 'Student']];
    }
}