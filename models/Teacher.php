<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Teacher extends DbModel
{
    public string $name = '';
    public string $specialized = '';
    public string $degree = '';
    public string $description = '';
    public string $avatar = '';

    public function tableName() : string
    {
        return 'teachers';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 100]],
            'description' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
            'specialized' => [self::RULE_REQUIRED],
            'degree' => [self::RULE_REQUIRED],
            'avatar' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes() : array
    {
        return ['name', 'description', 'specialized', 'degree', 'avatar'];
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
            'specialized' => 'Bộ môn',
            'degree' => 'Học vị',
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
            ['specialized' => ['001' => 'Khoa học máy tính', '002' => 'Khoa học dữ liệu', '003' => 'Hải dương học'],
                'degree' => ['001' => 'Cử nhân', '002' => 'Thạc sĩ' , '003' => 'Tiến sĩ', '004' => 'Phó giáo sư', '005' => 'Giáo sư']
            ];
    }
}