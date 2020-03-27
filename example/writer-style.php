<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();
    $writer->setFilename('test.xlsx')->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    $writer->getCurrentSheet()->getStyle('A')->getAlignment()->setWrapText(true);


    $type = [
        'A' => 'string'
    ];

    $writer->addHeader(['address'], $type);
    $writer->addRow(['address street city province country area zone']);
    $writer->addRow(['rocky xinzhuzhixiang test test test test testtest']);
    $writer->save();

} catch (\Exception $e) {
    echo $e->getMessage();
}