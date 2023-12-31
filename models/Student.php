<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Student extends DbModel
{
    public string $name = '';
    public string $description = '';
    public string $avatar = '';

    public function tableName() : string
    {
        return 'students';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 100]],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
            'avatar' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes() : array
    {
        return ['name', 'description', 'avatar'];
    }

    public function upload_attributes() : string
    {
        return 'avatar';
    }

    public function labels() : array
    {
        return [
            'name' => 'Họ và Tên',
            'description' => 'Mô tả thêm',
            'avatar' => 'Avatar'
        ];
    }
    public function primaryKey(): string
    {
        return 'id';
    }
}