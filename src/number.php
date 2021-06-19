<?php

/**
 * Randomize floating number
 */
if (!function_exists('random_float')) {
    function random_float(int $min = 0, int $max = PHP_INT_MAX, int $decimals = 2)
    {
        $value = random_int($min, $max - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
        return number_format($value, $decimals, '.', '');
    }
}