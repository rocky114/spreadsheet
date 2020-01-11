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
     * @return CSVWriter
     */
    public static function createCSVWriter()
    {
        $optionsManager = new CSVOptionsManager();
        $globalFunctionsHelper = new GlobalFunctionsHelper();

        $helperFactory = new HelperFactory();

        return new CSVWriter($optionsManager, $globalFunctionsHelper, $helperFactory);
    }

    /**
     * @return XLSXWriter
     */
    public static function createXLSXWriter()
    {
        $styleBuilder = new StyleBuilder();
        $optionsManager = new XLSXOptionsManager($styleBuilder);
        $globalFunctionsHelper = new GlobalFunctionsHelper();

        $helperFactory = new XLSXHelperFactory();
        $managerFactory = new XLSXManagerFactory(new InternalEntityFactory(), $helperFactory);

        return new XLSXWriter($optionsManager, $globalFunctionsHelper, $helperFactory, $managerFactory);
    }
}
