<?php

namespace app\models\forms;

use app\core\db\DbModel;

abstract class SearchForm extends DbModel
{
    public string $search_key = ''; // Search for "=" condition
    public array $keyword = [];  // Search for "LIKE" condition

    public function getNameSearchKey() : array
    {
        return ['search_key' => $this->search_key, 'key_word' => $this->keyword];
    }

    abstract public function getSearchValue() : array;

    public function search($searchKey, $searchValue)
    {
        return parent::search($searchKey, $searchValue);
    }
}