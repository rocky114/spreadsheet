<?php

include "../src/Autoload.php";

try {
    $writer = \Rocky114\Spreadsheet\WriterFactory::createXLSXWriter();

    $writer->setTempFolder('.');

    $writer->addNewSheet('sheet1');

    $type = [
        'A' => 'string',
        'B' => 'string',
        'C' => 'string',
        'D' => 'string',
    ];
    $writer->addHeader(['name', 'country', 'province', 'city'], $type);

    $name = 'name';
    $country = 'china';
    $province = 'jiangsu';
    $city = 'suzhou';

    $writer->addRow([$name, null, $province, $city]);
    $writer->addRow([null, null, $province, $city]);
    $writer->addRow([$name, $country, $province, $city]);

    $writer->mergeCell('A2', 'B3')->save();
} catch (\Exception $e) {
    echo $e->getMessage();
}