<?php

if (!function_exists('getSheetHeaderChar')) {
    /**
     * @param int $index
     * @return mixed
     */
    function getSheetHeaderChar(int $index)
    {
        $key = $index;
        static $columnHeader = [];

        if (!isset($columnHeader[$index])) {
            $chars = '';
            $asciiNumber = ord('A');
            $i = 0;
            do {
                $index = $i > 0 ? $index - 1 : $index;
                $chars = chr($index % 26 + $asciiNumber) . $chars;

                $index = intval($index / 26);
                $i++;
            } while ($index > 0);

            $columnHeader[$key] = $chars;
        }

        return $columnHeader[$key];
    }
}

if (!function_exists('getSheetHeaderIndex')) {
    /**
     * @param string $chars
     * @return int
     */
    function getSheetHeaderIndex(string $chars)
    {
        $key = $chars;

        static $columnHeader = [];

        if (!isset($columnHeader[$key])) {
            $chars = str_split(strrev($chars));

            $asciiNumber = ord('A');

            $number = 0;
            foreach ($chars as $index => $char) {
                $number += (ord($char) - $asciiNumber) + 26 * $index;

                if ($index === 0) {
                    $number += 1;
                }
            }

            $columnHeader[$key] = $number - 1;
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
        return $prefix . uniqid(php_uname('n') . getmypid(), true) . $suffix;
    }
}

if (!function_exists('isUTF8Code')) {
    /**
     * @param $string
     * @return bool
     */
    function isUTF8Code($string)
    {
        if (function_exists('mb_check_encoding')) {
            return mb_check_encoding($string, 'UTF-8') ? true : false;
        }

        return preg_match("//u", $string) ? true : false;
    }
}

if (!function_exists('download')) {
    /**
     * @param string $filename
     * @param string $filepath
     * @param string $contentType
     */
    function download(string $filename, string $filepath, $contentType = 'text/csv')
    {
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        readfile($filepath);
    }
}
