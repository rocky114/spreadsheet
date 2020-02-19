<?php

namespace Rocky114\Excel\Common;

class FunctionHelper
{
    public static function isXLSXFile($filename)
    {
        return 'xlsx' === pathinfo($filename, PATHINFO_EXTENSION);
    }

    public static function isCSVFile($filename)
    {
        return 'csv' === pathinfo($filename, PATHINFO_EXTENSION);
    }

    public static function createUniqueId($suffix = '', $prefix = '')
    {
        return $prefix.uniqid(php_uname('n').getmypid(), true).$suffix;
    }

    public static function isUTF8Code($string)
    {
        if (function_exists('mb_check_encoding')) {
            return mb_check_encoding($string, 'UTF-8') ? true : false;
        }

        return preg_match("//u", $string) ? true : false;
    }

    public static function getColumnHeader($index)
    {
        static $columnHeader = [];

        if (!isset($columnHeader[$index])) {
            $chars = '';
            $aAsciiNumber = ord('A');

            do {
                $chars = chr($index % 26 + $aAsciiNumber) . $chars;

                $index = intval($index / 26);
            } while ($index > 0);

            $columnHeader[$index] = $chars;
        }

        return $columnHeader[$index];
    }
}