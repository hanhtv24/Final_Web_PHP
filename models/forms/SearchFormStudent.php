<?php

namespace app\models\forms;

use app\models\Student;
use app\models\Subject;

class SearchFormStudent extends SearchForm
{
    public string $search_value = '';
    public string $keyword_value = '';
    public function __construct()
    {
        $this->search_key = '';
        $this->keyword = ['name', 'description'];
    }

    public function tableName(): string
    {
        return 'students';
    }

    public function labels() : array
    {
        return [
            'keyword_value' => 'Từ khóa',
        ];
    }

    public function attributes(): array
    {
        return ['keyword_value'];
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
        return Student::class;
    }
}