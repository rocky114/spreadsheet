<?php

namespace Rocky114\Spreadsheet;

use Rocky114\Spreadsheet\Writer\XLSX\Writer as XLSXWriter;
use Rocky114\Spreadsheet\Writer\CSV\Writer as CSVWriter;

class WriterFactory
{
    /**
     * @return \Rocky114\Spreadsheet\Writer\CSV\Writer
     */
    public static function createCSVWriter()
    {
        return new CSVWriter();
    }

    /**
     * @return \Rocky114\Spreadsheet\Writer\XLSX\Writer
     */
    public static function createXLSXWriter()
    {
        return new XLSXWriter();
    }
}