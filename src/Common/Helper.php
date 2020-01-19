<?php

namespace Rocky114\Excel\Common;

class Helper
{
    public function __construct()
    {
    }

    public function flushBuffer()
    {
        if (ob_get_length() > 0) {
            ob_end_clean();
        }
    }

    public function isXLSXFile($filename)
    {
        return 'xlsx' === pathinfo($filename, PATHINFO_EXTENSION);
    }
}