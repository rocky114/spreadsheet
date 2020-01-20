<?php

namespace Rocky114\Excel\Writer;

use Rocky114\Excel\Common\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Workbook;
use Rocky114\Excel\Writer\XLSX\Cell;
use Rocky114\Excel\Writer\XLSX\Row;
use Rocky114\Excel\Writer\XLSX\Writer as XLSXWriter;
use Rocky114\Excel\Writer\CSV\Writer as CSVWriter;

class WriterFactory
{
    public static function createCSVWriter()
    {
        return new CSVWriter();
    }

    public static function createXLSXWriter()
    {
        $zipHandle = new ZipHelper();
        return new XLSXWriter($zipHandle);
    }

    public static function createRow(array $cells = [], $style)
    {
        return new Row($cells, $style);
    }

    public static function createRowFromArray(array $cells, $style)
    {
        $items = array_map(function ($item) {
            return new Cell($item);
        }, $cells);

        return new Row($items, $style);
    }

    public static function createCell($value, $style)
    {
        return new Cell($value, $style);
    }
}