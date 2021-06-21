<?php

/**
 * URL redirect
 */
if (!function_exists('redirect_to')) {
    function redirect_to($to = '/')
    {
        header('Location: ' . $to);
        exit();
    }
}
