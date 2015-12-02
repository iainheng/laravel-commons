<?php
/**
 * Laravel Commons
 *
 * @author    Iain Heng <hengcs@gmail.com>
 * @copyright 2015 Heng Cheng Siang
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/hengcs/laravel-commons
 */

namespace Iainheng\LaravelCommons;


class Date
{
    /**
     * Print a date string by specifying a format
     *
     * @param string $string_date
     * @param string $format
     * @return bool|string
     */
    public static function format($string_date = null, $format = null)
    {
        if(!$string_date) $string_date = date('Y-m-d');

        if(!$format) $format = 'd/m/Y';

        return date($format, strtotime($string_date));
        
    }
}