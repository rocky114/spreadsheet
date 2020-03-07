<?php

namespace Rocky114\Spreadsheet;

use Rocky114\Spreadsheet\Reader\CSV\Reader as CSVReader;
use Rocky114\Spreadsheet\Reader\XLSX\Reader as XLSXReader;

class ReaderFactory
{
    /**
     * @param string $filePath
     * @return \Rocky114\Spreadsheet\Reader\ReaderInterface
     * @throws \Exception
     */
    public static function createReaderFromFile(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Could not open $filePath for reading! File does not exist.");
        }
        if (!is_readable($filePath)) {
            throw new \Exception("Could not open $filePath for reading! File is not readable.");
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if ($extension === 'csv') {
            return self::createCSVReader();
        } else if ($extension === 'xlsx') {
            return self::createXLSXReader();
        } else {
            throw new \Exception('Cannot read files, only csv, xlsx files are supported');
        }
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\CSV\Reader
     */
    public static function createCSVReader()
    {
        return new CSVReader();
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\XLSX\Reader
     */
    public static function createXLSXReader()
    {
        return new XLSXReader();
    }
}