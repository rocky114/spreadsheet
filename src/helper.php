<?php

if (!function_exists('getColumnHeader')) {
    /**
     * @param int $index
     * @return mixed
     */
    function getColumnHeader(int $index)
    {
        $key = $index;
        static $columnHeader = [];

        if (!isset($columnHeader[$index])) {
            $chars = '';
            $asciiNumber = ord('A');

            do {
                $chars = chr($index % 26 + $asciiNumber) . $chars;

                $index = intval($index / 26);
            } while ($index > 0);

            $columnHeader[$key] = $chars;
        }

        return $columnHeader[$key];
    }
}

if (!function_exists('createUniqueId')) {
    /**
     * @param string $suffix
     * @param string $prefix
     * @return string
     */
    function createUniqueId($suffix = '', $prefix = '')
    {
        return $prefix.uniqid(php_uname('n').getmypid(), true).$suffix;
    }
}

if (!function_exists('isUTF8Code')) {
    function isUTF8Code($string)
    {
        if (function_exists('mb_check_encoding')) {
            return mb_check_encoding($string, 'UTF-8') ? true : false;
        }

        return preg_match("//u", $string) ? true : false;
    }
}
