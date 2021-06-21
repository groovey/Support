<?php

/**
 * Custom money formating
 *
 * $amount accepts null, int, and float.
 */
if (!function_exists('format_money')) {
    function format_money($amount, bool $showCurrency = true)
    {
        if ($showCurrency) {
            $symbol = $symbol ?? config('money.symbol');
        } else {
            $symbol = '';
        }

        return $symbol . number_format($amount, 2);
    }
}

/**
 * Randomize a unique model base on condition
 *
 * Example usage: It means get a unique order that does not exist in wallet.
 * random_unique_model(Order::all(), fn ($id) => Wallet::where('order_id', $id)->first());
 */
if (!function_exists('random_unique_model')) {
    function random_unique_model($model, $condition)
    {
        $random    = $model->random();
        $duplicate = $condition($random->id);

        if ($duplicate) {
            return random_unique_model($model, $condition);
        }
        return $random;
    }
}
