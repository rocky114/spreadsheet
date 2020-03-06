<?php

namespace Rocky114\Spreadsheet;

use Rocky114\Spreadsheet\Writer\XLSX\Writer as XLSXWriter;
use Rocky114\Spreadsheet\Writer\CSV\Writer as CSVWriter;

class WriterFactory
{
    /**
     * @param array $config
     * @return \Rocky114\Spreadsheet\Writer\CSV\Writer
     */
    public static function createCSVWriter(array $config)
    {
        return new CSVWriter($config);
    }

    /**
     * @param array $config
     * @return \Rocky114\Spreadsheet\Writer\XLSX\Writer
     */
    public static function createXLSXWriter(array $config = [])
    {
        return new XLSXWriter($config);
    }
}