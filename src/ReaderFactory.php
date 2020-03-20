<?php

namespace Rocky114\Spreadsheet;

use Rocky114\Spreadsheet\Reader\CSV\Reader as CSVReader;
use Rocky114\Spreadsheet\Reader\XLSX\Reader as XLSXReader;

class ReaderFactory
{
    /**
     * @param string $path
     * @return \Rocky114\Spreadsheet\Reader\ReaderInterface
     * @throws \Exception
     */
    public static function createReaderFromFile(string $path)
    {
        $extension = strtolower(pathinfo(basename($path), PATHINFO_EXTENSION));
        if ($extension === 'csv') {
            $reader = self::createCSVReader();
        } else if ($extension === 'xlsx') {
            $reader = self::createXLSXReader();
        } else {
            throw new \Exception('Cannot read files, only csv, xlsx files are supported');
        }

        $reader->open($path);

        return $reader;
    }

    /**
     * @param string $name
     * @return CSVReader|XLSXReader
     * @throws \Exception
     */
    public static function createReaderFromStream(string $name = 'file')
    {
        if (empty($_FILES[$name]) || $_FILES[$name]['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Cannot read files, only csv, xlsx files are supported');
        }

        if ($_FILES[$name]['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $reader = self::createXLSXReader();
        } else if ($_FILES[$name]['type'] === 'text/csv') {
            $reader = self::createCSVReader();
        } else {
            throw new \Exception('Cannot read files, only csv, xlsx files are supported');
        }

        $reader->open($_FILES[$name]['tmp_file']);

        return $reader;
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