<?php

include "../src/Autoload.php";

try {
    $reader = \Rocky114\Spreadsheet\ReaderFactory::createReaderFromFile('./test.xlsx');

    $data = [];
    foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            $data[] = $row;
        }
    }

    //
    $data = $reader->getSheet(0)->load();

    echo '<pre>';
    print_r($data);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}




