<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Score extends DbModel
{
    public string $student_id = '';
    public string $teacher_id = '';
    public string $subject_id = '';
    public string $score = '';

    public string $description = '';

    public function tableName() : string
    {
        return 'scores';
    }

    public function rules(): array
    {
        return [
            'student_id' => [self::RULE_REQUIRED],
            'teacher_id' => [self::RULE_REQUIRED],
            'subject_id' => [self::RULE_REQUIRED],
            'score' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes() : array
    {
        return ['student_id', 'teacher_id', 'subject_id', 'score', 'description'];
    }

    public function upload_attributes() : string
    {
        return '';
    }
    public function labels() : array
    {
        return [
            'student_id' => 'Sinh viên',
            'teacher_id' => 'Giáo viên',
            'subject_id' => 'Môn học',
            'description' => 'Comment chi tiết',
            'score' => 'Điểm',
        ];
    }
    public function primaryKey(): string
    {
        return 'id';
    }

    public static function selectionValue()
    {
        $students = Student::findAll([], '=', ['id', 'name']);
        $teachers = Teacher::findAll([], '=', ['id', 'name']);
        $subjects = Subject::findAll([], '=', ['id', 'name']);

        $studentValue = array_column($students, 'name', 'id');

        $teacherValue = array_column($teachers, 'name', 'id');

        $subjectValue = array_column($subjects, 'name', 'id');
        $scoreValue = [];
        for ($i = 0; $i <= 10; $i++) {
            $scoreValue[$i] = (string) $i;
        }
        return ['student_id' => $studentValue,
                'teacher_id' => $teacherValue,
                'subject_id' => $subjectValue,
                'score' => $scoreValue];
    }
}