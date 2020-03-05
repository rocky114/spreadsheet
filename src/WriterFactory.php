<?php

namespace Rocky114\Excel;

use Rocky114\Excel\Writer\XLSX\Writer as XLSXWriter;
use Rocky114\Excel\Writer\CSV\Writer as CSVWriter;

class WriterFactory
{
    public static function createCSVWriter(array $config)
    {
        return new CSVWriter($config);
    }

    public static function createXLSXWriter(array $config = [])
    {
        return new XLSXWriter($config);
    }
}