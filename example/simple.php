<?php

include "../src/Autoload.php";

$writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter(['temp_folder' => '/Users/huangdongcheng/excel/storage']);

$writer->addNewSheet('sheet1');

$type = [
    'A' => 'string',
    'B' => '#,##0'
];
$writer->addHeader(['name', 'id'], $type)->addRow(['xinzhu', 1234565])->addRow(['rocky', 21])->save();

