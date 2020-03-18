<?php

include "../src/Autoload.php";

$reader = \Rocky114\Spreadsheet\ReaderFactory::createXLSXReader('/Users/huangdongcheng/Downloads/test.xlsx');
$reader->open();

$data = [];
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {
        $data[] = $row;
    }
}



