<?php

namespace app\core\form;

use app\core\Model;

class SelectionBoxField extends BaseField
{
    public array $options;

    /**
     * @param Model $model
     * @param string $attribute
     * @param array $options
     */
    public function __construct(Model $model, string $attribute, array $options = [])
    {
        parent::__construct($model, $attribute);
        $this->options = $options;
    }

    public function renderInput(): string
    {
        $optionStr = '';
        if ($this->model->{$this->attribute} === '') {
            $optionStr = '<option selected></option>';
        }
        foreach ($this->options as $index => $value) {
            if ($this->model->{$this->attribute} == $value) {
                $optionStr .= sprintf('<option value="%s" selected>%s</option>', $value, $value);
            } else {
                $optionStr .= sprintf('<option value="%s">%s</option>', $value, $value);
            }
        }

        return sprintf('<label class="form-label">%s</label>
                            <select class="form-select %s" name="%s">
                              %s
                            </select>',
           $this->model->getLabel($this->attribute),
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            $optionStr,
       );
    }
}