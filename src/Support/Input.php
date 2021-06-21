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

    // public function old_array($field)
    // {
    //     $data = collect();
    //     if (old($field)) {
    //         for ($i = 0; $i < count(old($field)); $i++) {
    //             $data->push(old('category.' . $i));
    //         }
    //     }
    //     return $data;
    // }
}