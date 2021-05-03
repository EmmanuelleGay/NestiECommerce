<?php

namespace App\Tools;


/**
 * Util
 * Format-related convenience methods.
 */
class FormatUtil
{


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
}