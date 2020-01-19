<?php

//include "Autoload.php";

//use Rocky114\Excel\Writer\Common\Creator\WriterEntityFactory;

//WriterEntityFactory::createCell(1);

echo memory_get_peak_usage().'-'.memory_get_usage().PHP_EOL;

$datas = [];

class data
{
    public $result = null;
}

foreach (range(1, 10000) as $item)
{
    $data[] = 'test';
}

$obj = new data();
$obj->result = $data;

echo memory_get_peak_usage().'-'.memory_get_usage().PHP_EOL;
