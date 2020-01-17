<?php

namespace Rocky114\Excel;

class Autoload
{
    public function load($name)
    {
        $filePath = $this->getFullFilePath($name);

        include "$filePath";
    }

    public function getFullFilePath($filename = null)
    {
        $prefix = 'Rocky114\Excel';

        $filename = str_replace($prefix, '', $filename);

        return __DIR__.$filename.'.php';
    }
}

$autoload = new Autoload();

spl_autoload_register([$autoload, 'load'], true);

