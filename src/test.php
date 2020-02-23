<?php

include "Autoload.php";

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    die;
}

$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter();

$writer->addNewSheet('sheet');

$writer->addHeader(['name', 'id'])->addRow(['xinzhu', 1])->save();
