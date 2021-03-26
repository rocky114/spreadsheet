# EXCEL

this is a PHP library to read and write spreadsheet files (CSV, XLSX), in a fast and scalable way.

## Requirements

* PHP version 7.1 or higher
* PHP extension `php_zip` enabled
* PHP extension `php_xmlreader` enabled

## Tips
If you have any ideas, please contact me and I will try to achieve

## Writer example
```
include "./vendor/autoload.php";

$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter();
$writer->setTempFolder('.');

$writer->addNewSheet('sheet1');

$type = [
    'A' => 'string',
    'B' => '#,##0'
];
$writer->addHeader(['name', 'id'], $type)->addRow(['xinzhu', 1234565])->addRow(['rocky', 21])->save();
```

## Reader example

```
include "./vendor/autoload.php";

$reader = \Rocky114\Spreadsheet\ReaderFactory::createReaderFromFile('./test.xlsx');

$data = [];
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {
        $data[] = $row;
    }
}

// or
$data = $reader->getSheet()->load();
```
