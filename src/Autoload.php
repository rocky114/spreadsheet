<?php

namespace Rocky114\Spreadsheet;

class Autoload
{
    public function load($name)
    {
        $filePath = $this->getFullFilePath($name);

        include "$filePath";
    }

    public function getFullFilePath($filename = null)
    {
        $prefix = 'Rocky114\Spreadsheet';

        $filename = str_replace([$prefix, '\\'], ['', '/'], $filename);

        return __DIR__.$filename.'.php';
    }
}

$autoload = new Autoload();

spl_autoload_register([$autoload, 'load'], true);

include "helper.php";


