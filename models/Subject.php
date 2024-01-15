<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Subject extends DbModel
{
    public string $name = '';
    public string $avatar = '';
    public string $description = '';
    public string $school_year = '';

    public function tableName() : string
    {
        return 'subjects';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 100]],
            'school_year' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
            'avatar' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes() : array
    {
        return ['name', 'school_year', 'description', 'avatar'];
    }

    public function upload_attributes() : string
    {
        return 'avatar';
    }
    public function labels() : array
    {
        return [
            'name' => 'Tên môn học',
            'school_year' => 'Khóa học',
            'description' => 'Mô tả chi tiết',
            'avatar' => 'Avatar'
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public static function selectionValue()
    {
        return
            ['school_year' => ['001' => 'Năm 1', '002' => 'Năm 2', '003' => 'Năm 3', '004' => 'Năm 4']];
    }
}