<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_FILE = 'file';
    public const TYPE_HIDDEN = 'hidden';

    public bool $hasLabel = true;

    public string $type;
    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField(): InputField
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function hiddenField(): InputField
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function noneLabelField(): InputField
    {
        $this->hasLabel = false;
        return $this;
    }

    public function fileField(): InputField
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function renderInput(): string
    {
        $label = '';
        if ($this->hasLabel) {
            $label = sprintf('<label class="form-label">%s</label>', $this->model->getLabel($this->attribute));
        }
        $input = sprintf(
            '<input type="%s" name="%s" value="%s" class="form-control %s" %s>',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->isReadOnly ? 'readonly' : '',
        );
        return $label . $input;
    }
}