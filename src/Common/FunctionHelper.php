<?php

namespace Rocky114\Excel\Common;

class FunctionHelper
{
    public function __construct()
    {
    }

    public static function flushBuffer()
    {
        if (ob_get_length() > 0) {
            ob_end_clean();
        }
    }

    public static function isXLSXFile($filename)
    {
        return 'xlsx' === pathinfo($filename, PATHINFO_EXTENSION);
    }

    public static function isCSVFile($filename)
    {
        return 'csv' === pathinfo($filename, PATHINFO_EXTENSION);
    }

    public static function uuid()
    {
        $chars = uniqid(mt_rand(10000, 99999), true);
        $chars = str_replace('.', '', $chars).mt_rand(10000, 99999);

        $uuid = substr($chars, 0, 8).'-'.substr($chars, 8, 4)
            .'-'.substr($chars, 12, 4) .'-'.substr($chars, 16, 4)
            .'-'.substr($chars, 20, 12);

        return $uuid;
    }
}