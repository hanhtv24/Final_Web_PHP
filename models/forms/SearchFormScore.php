<?php

namespace app\models\forms;

use app\core\db\DbModel;
use app\models\Score;

class SearchFormScore extends SearchForm
{
    public string $student_id = '';
    public string $subject_id = '';
    public string $teacher_id = '';

    public function __construct()
    {
        $this->search_key = '';
        $this->keyword = ['student_id', 'teacher_id', 'subject_id'];
    }
    public function tableName(): string
    {
        return 'scores';
    }
    public function labels() : array
    {
        return [
            'student_id' => 'Sinh viên',
            'subject_id' => 'Môn học',
            'teacher_id' => 'Giáo viên',
        ];
    }

    public function attributes(): array
    {
        return ['student_id', 'subject_id', 'teacher_id'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    public function getSearchValue() : array
    {
        return ['search_key' => '','key_word' => [
            'student_id' => $this->student_id, 'subject_id' => $this->subject_id, 'teacher_id' => $this->teacher_id]];
    }

    public function getClassSearch()
    {
        return Score::class;
    }
}