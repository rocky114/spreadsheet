# EXCEL

excel is a PHP library to read and write spreadsheet files (CSV, XLSX), in a fast and scalable way.

## Requirements

* PHP version 7.1 or higher
* PHP extension `php_zip` enabled
* PHP extension `php_xmlreader` enabled

## Simple example
```
$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter(['temp_folder' => '/']);

$writer->addNewSheet('sheet1');

$type = [
    'A' => 'string',
    'B' => '#,##0'
];
$writer->addHeader(['name', 'id'], $type)->addRow(['xinzhu', 1234565])->addRow(['rocky', 21])->save();
```