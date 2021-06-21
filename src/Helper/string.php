<?php

/**
 * Predefined string padding
 */
if (!function_exists('string_pad')) {
    function string_pad(string $value, int $length = 2, string $padding = '0', int $type = STR_PAD_LEFT)
    {
        return str_pad($value, $length, $padding, $type);
    }
}

/**
 * Mask the string with *
 */
if (!function_exists('string_mask')) {
    function string_mask(string $value, int $offset = -4, string $replacement = '*')
    {
        $length   = strlen($value);
        $last     = substr($value, -4);
        $asterisk = preg_replace("/\S/", $replacement, $value);
        $mask     = substr($asterisk, 0, $length - 4);
        return $mask . $last;
    }
}
