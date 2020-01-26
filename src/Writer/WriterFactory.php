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
        return new XLSXWriter();
    }
}