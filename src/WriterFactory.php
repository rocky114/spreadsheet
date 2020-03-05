<?php

namespace Rocky114\Excel;

use Rocky114\Excel\Writer\XLSX\Writer as XLSXWriter;
use Rocky114\Excel\Writer\CSV\Writer as CSVWriter;

class WriterFactory
{
    /**
     * @param array $config
     * @return \Rocky114\Excel\Writer\CSV\Writer
     */
    public static function createCSVWriter(array $config)
    {
        return new CSVWriter($config);
    }

    /**
     * @param array $config
     * @return \Rocky114\Excel\Writer\XLSX\Writer
     */
    public static function createXLSXWriter(array $config = [])
    {
        return new XLSXWriter($config);
    }
}