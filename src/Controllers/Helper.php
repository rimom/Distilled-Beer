<?php
/**
 *Class with helpers functions
 *
 *This is an abstract class and it shall be used only to call some specific function
 *
 * @author Rimom Costa<rimomcosta@gmail.com>
 * @date 05 of February - 2018
 *
 */

namespace Controllers;

abstract class Helper
{

    /**
     * @param string $input
     * @return string
     */
    public static function sanitize(string $input): string
    {
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);
        $input = str_replace(' ', '%20', $input);//requirement from BreweryDB API
        return $input;
    }

    /**
     * @param string $text
     * @param int $limit
     * @return string
     */
    public static function textShorten(string $text, int $limit = 150): string
    {
        $text = strip_tags($text);
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . "...";
        return $text;
    }
}