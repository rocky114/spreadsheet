<?php

namespace Rocky114\Excel;

use Rocky114\Excel\Reader\CSV\Reader as CSVReader;
use Rocky114\Excel\Reader\XLSX\Reader as XLSXReader;

class ReaderFactory
{
    /**
     * @param string $path
     * @return \Rocky114\Excel\Reader\ReaderInterface
     * @throws \Exception
     */
    public static function createReaderFromFile(string $path)
    {
        $extension = \strtolower(\pathinfo($path, PATHINFO_EXTENSION));
        if ($extension === 'csv') {
            return self::createCSVReader();
        } else if ($extension === 'xlsx') {
            return self::createXLSXReader();
        } else {
            throw new \Exception('Cannot read files, only csv, xlsx files are supported');
        }
    }

    /**
     * @return \Rocky114\Excel\Reader\CSV\Reader
     */
    public static function createCSVReader()
    {
        return new CSVReader();
    }

    /**
     * @return \Rocky114\Excel\Reader\XLSX\Reader
     */
    public static function createXLSXReader()
    {
        return new XLSXReader();
    }
}