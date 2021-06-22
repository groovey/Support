<?php

namespace Pandango\Support;

class Input
{
    /**
     * Checks if the one of the field has error
     */
    public function get($model, $field, $default = null)
    {
        return old($field) ?? request()->input($field) ?? $model->$field ?? $default;
    }
}