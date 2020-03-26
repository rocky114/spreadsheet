<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();

    $writer->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    $type = [
        'A' => 'string',
        'B' => '#,##0',
        'C' => 'string',
        'D' => 'string',
        'E' => 'string'
    ];
    $writer->addHeader(['name', 'money', 'country', 'province', 'city'], $type);

    foreach (range(1, 10) as $index => $item) {
        $name = 'name';
        $money = 10;
        $country = 'china';
        $province = 'jiangsu';
        $city = 'suzhou';

        $writer->addRow([$name, $money, $country, $province, $city]);
    }

    $writer->mergeCell('A1', 'B2')->save();
} catch (\Exception $e) {
    echo $e->getMessage();
}