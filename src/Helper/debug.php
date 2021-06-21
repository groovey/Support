<?php

/**
 * Debug query logs
 */
if (!function_exists('debug_query_start')) {
    function debug_query_start()
    {
        return Illuminate\Support\Facades\DB::enableQueryLog();
    }
}

/**
 * Debug query logs
 */
if (!function_exists('debug_query_end')) {
    function debug_query_end()
    {
        dd(Illuminate\Support\Facades\DB::getQueryLog());
    }
}

/**
 * Outputs sql query string
 */
if (!function_exists('debug_query')) {
    function debug_query(Illuminate\Database\Query\Builder $instance)
    {
        return dd($instance->toSql());
    }
}
