<?php

/**
 * Random date from carbon
 */
if (!function_exists('date_random')) {
    function date_random(int $days = 30, string $format = null)
    {
        $date = Carbon\Carbon::now()->subDays(rand(1, $days))->addMinutes(rand(1, 60));

        if ($format) {
            return $date->format($format);
        }

        return $date;
    }
}

/**
 * Shows date in readable format
 */
if (!function_exists('date_diff_for_humans')) {
    function date_diff_for_humans(string $date)
    {
        return Carbon\Carbon::parse($date)->diffForhumans();
    }
}

/**
 * Format dates in multiple forms
 */
if (!function_exists('date_format_to')) {
    function date_format_to(string $date, string $format = null)
    {
        $date = Carbon\Carbon::parse($date);
        if ($format) {
            return $date->format($format);
        }

        return $date;
    }
}