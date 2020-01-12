<?php

namespace Rocky114\Excel\Reader\Common\Creator;

use Rocky114\Excel\Common\Exception\UnsupportedTypeException;
use Rocky114\Excel\Common\Type;
use Rocky114\Excel\Reader\ReaderInterface;

/**
 * Class ReaderEntityFactory
 * Factory to create external entities
 */
class ReaderEntityFactory
{
    /**
     * Creates a reader by file extension
     *
     * @param string $path The path to the spreadsheet file. Supported extensions are .csv, .ods and .xlsx
     * @throws \Rocky114\Excel\Common\Exception\UnsupportedTypeException
     * @return ReaderInterface
     */
    public static function createReaderFromFile(string $path)
    {
        return ReaderFactory::createFromFile($path);
    }

    /**
     * This creates an instance of a CSV reader
     *
     * @return \Rocky114\Excel\Reader\CSV\Reader
     */
    public static function createCSVReader()
    {
        try {
            return ReaderFactory::createFromType(Type::CSV);
        } catch (UnsupportedTypeException $e) {
            // should never happen
        }
    }

    /**
     * This creates an instance of a XLSX reader
     *
     * @return \Rocky114\Excel\Reader\XLSX\Reader
     */
    public static function createXLSXReader()
    {
        try {
            return ReaderFactory::createFromType(Type::XLSX);
        } catch (UnsupportedTypeException $e) {
            // should never happen
        }
    }

    /**
     * This creates an instance of a ODS reader
     *
     * @return \Rocky114\Excel\Reader\ODS\Reader
     */
    public static function createODSReader()
    {
        try {
            return ReaderFactory::createFromType(Type::ODS);
        } catch (UnsupportedTypeException $e) {
            // should never happen
        }
    }
}
