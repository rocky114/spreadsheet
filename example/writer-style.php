<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();
    $writer->setFilename('test.xlsx')->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    $writer->getCurrentSheet()->getStyle('D7')->getType()->setNumberFormats('string');

    $writer->addRow([null]);
    $writer->addRow([null, 'TAX INVOICE']);
    $writer->addRow([null]);
    $writer->addRow([null]);
    $writer->addRow([null, 'Invoice Date', null, '16/01/2020', null, null, null, null, null, null, 'Green Fun Alliance LTD']);
    $writer->addRow([null, 'Invoice No', null, 'INV000304', null, null, null, null, null, null, 'Unit 6 Crown Way, Walworth Industrial Estate, Andover, Hampshire England, SP10 5LU']);
    $writer->addRow([null, 'Order No', null, '20200116083331', null, null, null, null, null, null, 'T:01264 586303']);
    $writer->addRow([null, 'Po No', null, 'dengyu2020-01-16', null, null, null, null, null, null, 'E:business@deepvaping.co.uk']);
    $writer->addRow([null, null, null, null, null, null, null, null, null, null, 'W:https://www.baidu.com']);
    $writer->addRow([null]);

    $products = [
        [
            null, '#', 'SKU', null, null, 'Description', null, null, null, null, null, null, 'Quantity', null, 'Unit Price', null, 'Amount'
        ],
        [
            null, 1, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
        [
            null, 2, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
        [
            null, 3, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
        [
            null, 4, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
        [
            null, 5, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
        [
            null, 6, '157499991412495838', null, null, 'dengyu UK 112901(CS|Cherry Blossom)', null, null, null, null, null, null, 5, null, 100, null, 500
        ],
    ];

    $writer->addRows($products);

    $writer->mergeCell('B2', 'F3');
    $writer->mergeCell('B5', 'C5')->mergeCell('D5', 'F5')->mergeCell('K5', 'R5');
    $writer->mergeCell('B6', 'C6')->mergeCell('D6', 'F6')->mergeCell('K6', 'R6');
    $writer->mergeCell('B7', 'C7')->mergeCell('D7', 'F7')->mergeCell('K7', 'R7');
    $writer->mergeCell('B8', 'C8')->mergeCell('D8', 'F8')->mergeCell('K8', 'R8');
    $writer->mergeCell('K9', 'R9');

    foreach ($products as $index => $item) {
        $rowNumber = 11 + $index;
        $writer->mergeCell('C'.$rowNumber, 'E'.$rowNumber)->mergeCell('F'.$rowNumber, 'L'.$rowNumber)->mergeCell('M'.$rowNumber, 'N'.$rowNumber)->mergeCell('O'.$rowNumber, 'P'.$rowNumber)->mergeCell('Q'.$rowNumber, 'R'.$rowNumber);
    }

    $writer->save();
} catch (\Exception $e) {
    echo $e->getMessage();
}