<?php


include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();

    $writer->setTempFolder('.');

    $writer->addNewSheet('sheet1');

} catch (\Exception $e) {
    echo $e->getMessage();
}