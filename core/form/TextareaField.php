<?php

namespace app\core\form;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
       return sprintf('<label class="form-label">%s</label>
                        <textarea name="%s" class="form-control %s" %s>%s</textarea>',
           $this->model->getLabel($this->attribute),
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->isReadOnly ? 'readonly' : '',
            $this->model->{$this->attribute}
       );
    }
}