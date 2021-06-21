<?php

namespace Pandango\Support;

class Validation
{
    /**
     * Checks if the one of the field has error
     */
    public function tabError($fields, $errors)
    {
        if (!$errors->count()) {
            return null;
        }

        foreach ($fields as $field) {
            if ($errors->has($field)) {
                return 'required';
                break;
            }
        }
        return null;
    }
}