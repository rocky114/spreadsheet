<?php

namespace Rocky114\Excel\Reader\Common\Creator;

use Rocky114\Excel\Common\Creator\HelperFactory;
use Rocky114\Excel\Common\Exception\UnsupportedTypeException;
use Rocky114\Excel\Common\Type;
use Rocky114\Excel\Reader\CSV\Creator\InternalEntityFactory as CSVInternalEntityFactory;
use Rocky114\Excel\Reader\CSV\Manager\OptionsManager as CSVOptionsManager;
use Rocky114\Excel\Reader\CSV\Reader as CSVReader;
use Rocky114\Excel\Reader\ODS\Creator\HelperFactory as ODSHelperFactory;
use Rocky114\Excel\Reader\ODS\Creator\InternalEntityFactory as ODSInternalEntityFactory;
use Rocky114\Excel\Reader\ODS\Creator\ManagerFactory as ODSManagerFactory;
use Rocky114\Excel\Reader\ODS\Manager\OptionsManager as ODSOptionsManager;
use Rocky114\Excel\Reader\ODS\Reader as ODSReader;
use Rocky114\Excel\Reader\ReaderInterface;
use Rocky114\Excel\Reader\XLSX\Creator\HelperFactory as XLSXHelperFactory;
use Rocky114\Excel\Reader\XLSX\Creator\InternalEntityFactory as XLSXInternalEntityFactory;
use Rocky114\Excel\Reader\XLSX\Creator\ManagerFactory as XLSXManagerFactory;
use Rocky114\Excel\Reader\XLSX\Manager\OptionsManager as XLSXOptionsManager;
use Rocky114\Excel\Reader\XLSX\Manager\SharedStringsCaching\CachingStrategyFactory;
use Rocky114\Excel\Reader\XLSX\Reader as XLSXReader;

/**
 * Class ReaderFactory
 * This factory is used to create readers, based on the type of the file to be read.
 * It supports CSV, XLSX and ODS formats.
 */
class ReaderFactory
{
    /**
     * Creates a reader by file extension
     *
     * @param string $path The path to the spreadsheet file. Supported extensions are .csv,.ods and .xlsx
     * @throws \Rocky114\Excel\Common\Exception\UnsupportedTypeException
     * @return ReaderInterface
     */
    public static function createFromFile(string $path)
    {
        $extension = \strtolower(\pathinfo($path, PATHINFO_EXTENSION));

        return self::createFromType($extension);
    }

    /**
     * This creates an instance of the appropriate reader, given the type of the file to be read
     *
     * @param  string $readerType Type of the reader to instantiate
     * @throws \Rocky114\Excel\Common\Exception\UnsupportedTypeException
     * @return ReaderInterface
     */
    public static function createFromType($readerType)
    {
        switch ($readerType) {
            case Type::CSV: return self::createCSVReader();
            case Type::XLSX: return self::createXLSXReader();
            case Type::ODS: return self::createODSReader();
            default:
                throw new UnsupportedTypeException('No readers supporting the given type: ' . $readerType);
        }
    }

    /**
     * @return CSVReader
     */
    private static function createCSVReader()
    {
        $optionsManager = new CSVOptionsManager();
        $helperFactory = new HelperFactory();
        $entityFactory = new CSVInternalEntityFactory($helperFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new CSVReader($optionsManager, $globalFunctionsHelper, $entityFactory);
    }

    /**
     * @return XLSXReader
     */
    private static function createXLSXReader()
    {
        $optionsManager = new XLSXOptionsManager();
        $helperFactory = new XLSXHelperFactory();
        $managerFactory = new XLSXManagerFactory($helperFactory, new CachingStrategyFactory());
        $entityFactory = new XLSXInternalEntityFactory($managerFactory, $helperFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new XLSXReader($optionsManager, $globalFunctionsHelper, $entityFactory, $managerFactory);
    }

    /**
     * @return ODSReader
     */
    private static function createODSReader()
    {
        $optionsManager = new ODSOptionsManager();
        $helperFactory = new ODSHelperFactory();
        $managerFactory = new ODSManagerFactory();
        $entityFactory = new ODSInternalEntityFactory($helperFactory, $managerFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new ODSReader($optionsManager, $globalFunctionsHelper, $entityFactory);
    }
}
