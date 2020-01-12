<?php

namespace Rocky114\Excel\Writer\Common\Creator;

use Rocky114\Excel\Common\Creator\HelperFactory;
use Rocky114\Excel\Common\Exception\UnsupportedTypeException;
use Rocky114\Excel\Common\Helper\GlobalFunctionsHelper;
use Rocky114\Excel\Common\Type;
use Rocky114\Excel\Writer\Common\Creator\Style\StyleBuilder;
use Rocky114\Excel\Writer\CSV\Manager\OptionsManager as CSVOptionsManager;
use Rocky114\Excel\Writer\CSV\Writer as CSVWriter;
use Rocky114\Excel\Writer\WriterInterface;
use Rocky114\Excel\Writer\XLSX\Creator\HelperFactory as XLSXHelperFactory;
use Rocky114\Excel\Writer\XLSX\Creator\ManagerFactory as XLSXManagerFactory;
use Rocky114\Excel\Writer\XLSX\Manager\OptionsManager as XLSXOptionsManager;
use Rocky114\Excel\Writer\XLSX\Writer as XLSXWriter;

/**
 * Class WriterFactory
 * This factory is used to create writers, based on the type of the file to be read.
 * It supports CSV, XLSX and ODS formats.
 */
class WriterFactory
{
    /**
     * This creates an instance of the appropriate writer, given the extension of the file to be written
     *
     * @param string $path The path to the spreadsheet file. Supported extensions are .csv,.ods and .xlsx
     * @throws \Rocky114\Excel\Common\Exception\UnsupportedTypeException
     * @return WriterInterface
     */
    public static function createFromFile(string $path)
    {
        $extension = \strtolower(\pathinfo($path, PATHINFO_EXTENSION));

        return self::createFromType($extension);
    }

    /**
     * This creates an instance of the appropriate writer, given the type of the file to be written
     *
     * @param string $writerType Type of the writer to instantiate
     * @throws \Rocky114\Excel\Common\Exception\UnsupportedTypeException
     * @return WriterInterface
     */
    public static function createFromType($writerType)
    {
        switch ($writerType) {
            case Type::CSV: return self::createCSVWriter();
            case Type::XLSX: return self::createXLSXWriter();
            default:
                throw new UnsupportedTypeException('No writers supporting the given type: ' . $writerType);
        }
    }

    /**
     * @return CSVWriter
     */
    private static function createCSVWriter()
    {
        $optionsManager = new CSVOptionsManager();
        $globalFunctionsHelper = new GlobalFunctionsHelper();

        $helperFactory = new HelperFactory();

        return new CSVWriter($optionsManager, $globalFunctionsHelper, $helperFactory);
    }

    /**
     * @return XLSXWriter
     */
    private static function createXLSXWriter()
    {
        $styleBuilder = new StyleBuilder();
        $optionsManager = new XLSXOptionsManager($styleBuilder);
        $globalFunctionsHelper = new GlobalFunctionsHelper();

        $helperFactory = new XLSXHelperFactory();
        $managerFactory = new XLSXManagerFactory(new InternalEntityFactory(), $helperFactory);

        return new XLSXWriter($optionsManager, $globalFunctionsHelper, $helperFactory, $managerFactory);
    }
}
