<?php

namespace Rocky114\Excel;

class Autoload
{
    public function load($name)
    {
        $realpath = $this->addNamespace();

        include $realpath.$name;
    }

    public function addNamespace($prefix = 'Rocky114\Excel', $dir = __DIR__)
    {
        $dir = '';

        return $dir;
    }
}

$autoload = new Autoload();

spl_autoload_register([$autoload, 'load'], true);

