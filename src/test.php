<?php

include "Autoload.php";

function dd($data)
{
    echo $data;
    die;
}

$writer = \Rocky114\Excel\Writer\WriterFactory::createXLSXWriter(['temp_folder' => '/Users/huangdongcheng/excel/storage']);

$writer->addNewSheet('sheet1');

$writer->addHeader(['name', 'id'])->addRow(['xinzhu', 1])->save();

require_once '../vendor/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

function spoutExcel()
{
    $writer = WriterEntityFactory::createXLSXWriter();

    $writer->openToFile('/Users/huangdongcheng/excel/storage/1.xlsx'); // write data to a file or to a PHP stream

    $cells = [
        WriterEntityFactory::createCell('name'),
        WriterEntityFactory::createCell('id'),
    ];

    /** add a row at a time */
    $singleRow = WriterEntityFactory::createRow($cells);
    $writer->addRow($singleRow);

    /** Shortcut: add a row from an array of values */
    $values = ['xinzhu', 1];
    $rowFromValues = WriterEntityFactory::createRowFromArray($values);
    $writer->addRow($rowFromValues);

    $writer->close();
}


