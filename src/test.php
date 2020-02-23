<?php

include "Autoload.php";

function dd($data)
{
    echo $data;
    die;
}

$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter(['temp_folder' => '/Users/huangdongcheng/excel/storage']);

$writer->addNewSheet('sheet');

$writer->addHeader(['name', 'id'])->addRow(['xinzhu', 1])->save();
