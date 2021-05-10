<?php

namespace App\Tools;


/**
 * Util
 * Format-related convenience methods.
 */
class FormatUtil
{
    protected static $translations = [
        'easy' => 'Facile',
        'seasonal' => 'De saison',
        'traditionnal' => 'Traditionnelle',
        'glutenFree' => 'Sans gluten',
    ];


    /**
     * dump
     * generates an html representation of a variable
     * 
     * @param  mixed $var to display in html
     * @return void
     */
    public static function dump($var)
    {
        echo "<pre>" . htmlentities(print_r($var, true)) . "</pre>";
    }

    public static function translate($english)
    {
        return static::$translations[strtolower($english)];
    }
}
