# EXCEL

this is a PHP library to read and write spreadsheet files (CSV, XLSX), in a fast and scalable way.

## Requirements

* PHP version 7.1 or higher
* PHP extension `php_zip` enabled
* PHP extension `php_xmlreader` enabled

## writer example
```
$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter();

$writer->addNewSheet('sheet1');

$type = [
    'A' => 'string',
    'B' => '#,##0'
];
$writer->addHeader(['name', 'id'], $type)->addRow(['xinzhu', 1234565])->addRow(['rocky', 21])->save();
```

## reader example

```
$reader = \Rocky114\Spreadsheet\ReaderFactory::createXLSXReader('/Users/huangdongcheng/Downloads/test.xlsx');
$reader->open();

$data = [];
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {
        $data[] = $row;
    }
}
```