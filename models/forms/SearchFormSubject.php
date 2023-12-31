<?php

namespace app\models\forms;

use app\models\Subject;

class SearchFormSubject extends SearchForm
{
    public string $search_value = '';
    public string $keyword_value = '';
    public function __construct()
    {
        $this->search_key = 'school_year';
        $this->keyword = ['name', 'description'];
    }

    public function tableName(): string
    {
        return 'subjects';
    }

    public function labels() : array
    {
        return [
            'search_value' => 'Khóa học',
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
        return Subject::class;
    }
}