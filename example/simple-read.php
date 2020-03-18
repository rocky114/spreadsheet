<?php

include "../src/Autoload.php";

$reader = \Rocky114\Spreadsheet\ReaderFactory::createXLSXReader('/Users/huangdongcheng/Downloads/test.xlsx');
$reader->open();

$data = [];
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($reader->getSheetIterator()->getRowIterator() as $row) {
        $data[] = $row;
    }
}

echo '<pre>';
print_r($data);



