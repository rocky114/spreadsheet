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
}