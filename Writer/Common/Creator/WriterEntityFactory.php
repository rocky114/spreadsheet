<?php

namespace Rocky114\Excel\Writer\Common\Creator;

use Rocky114\Excel\Common\Entity\Cell;
use Rocky114\Excel\Common\Entity\Row;
use Rocky114\Excel\Common\Entity\Style\Style;

class WriterEntityFactory
{
    public static function createWriter($writerType)
    {

    }

    public static function createWriteFromFile(string $path)
    {

    }

    public static function createXLSXWriter()
    {

    }

    public static function createCSVWriter()
    {

    }

    public static function createRow(array $cells = [], Style $rowStyle = null)
    {
        return new Row($cells, $rowStyle);
    }

    public static function createRowFromArray(array $cellValues = [], Style $rowStyle = null)
    {

    }

    public static function createCell($cellValue, Style $cellStyle = null)
    {

    }
}