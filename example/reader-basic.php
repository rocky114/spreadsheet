<?php

include "../src/Autoload.php";

$reader = \Rocky114\Spreadsheet\ReaderFactory::createReaderFromFile('./test.xlsx');

$data = [];
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {
        $data[] = $row;
    }
}



