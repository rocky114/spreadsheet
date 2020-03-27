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

    $writer->addRow([$name, $country, $province, $city]);
    $writer->addRow([$name, $country, $province, $city]);
    $writer->addRow([$name, $country, $province, $city]);

    $writer->addNewSheet('sheet2');
    $writer->addHeader(['home', 'age', 'quantity']);

    $writer->addRows([
        ['guanyun', 11, 10],
        ['guanyun', 11, 23],
        ['town', 13, 2]
    ]);

    $writer->save();

} catch (\Exception $e) {
    echo $e->getMessage();
}
