<?php

/**
 * Randomize an array
 */
if (!function_exists('random_array')) {
    function random_array($data)
    {
        return $data[array_rand($data)];
    }
}