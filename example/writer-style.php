<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();
    $writer->setFilename('test.xlsx')->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    //$writer->getCurrentSheet()->getStyle('A')->getAlignment()->setWrapText(true);

    $writer->addRow([null]);
    $writer->addRow([null, 'TAX INVOICE']);
    $writer->addRow([null]);
    $writer->mergeCell('B2', 'F3')->save();
} catch (\Exception $e) {
    echo $e->getMessage();
}