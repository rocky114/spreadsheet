<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();

    $writer->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    $type = [
        'A' => 'string',
        'B' => '#,##0'
    ];
    $writer->addHeader(['name', 'id'], $type)->addRow(['xinzhu', 1234565])->addRow(['rocky', 21])->download();
} catch (\Exception $e) {
    echo $e->getMessage();
}



