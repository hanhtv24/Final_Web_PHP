<?php

namespace app\models\forms;

use app\models\Subject;
use app\models\Teacher;

class SearchFormTeacher extends SearchForm
{
    public string $search_value = '';
    public string $keyword_value = '';
    public function __construct()
    {
        $this->search_key = 'specialized';
        $this->keyword = ['name', 'description', 'degree'];
    }

    public function tableName(): string
    {
        return 'teachers';
    }

    public function labels() : array
    {
        return [
            'search_value' => 'Bộ môn',
            'keyword_value' => 'Từ khóa',
        ];
    }

    public function attributes(): array
    {
        return ['search_value', 'keyword_value'];
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
        return ['search_key' => $this->search_value, 'key_word' => $this->keyword_value];
    }

    public function getClassSearch()
    {
        return Teacher::class;
    }
}