<?php

namespace Rocky114\Excel\Writer;

use Rocky114\Excel\Writer\XLSX\Cell;
use Rocky114\Excel\Writer\XLSX\Row;

class WriterFactory
{
    public static function createCSVWriter()
    {

    }

    public static function createXLSXWriter()
    {

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