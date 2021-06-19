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