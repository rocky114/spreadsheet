<?php

include "Autoload.php";

//use Rocky114\Excel\Writer\Common\Creator\WriterEntityFactory;

//WriterEntityFactory::createCell(1);

use Rocky114\Excel\Writer\XLSX\Row;

$rowHandle = new Row();

var_dump($rowHandle->getColumnIndexMap(28));