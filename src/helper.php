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
            $aAsciiNumber = ord('A');

            do {
                $chars = chr($index % 26 + $aAsciiNumber) . $chars;

                $index = intval($index / 26);
            } while ($index > 0);

            $columnHeader[$key] = $chars;
        }

        return $columnHeader[$key];
    }
}
