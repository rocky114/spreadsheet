<?php

namespace Rocky114\Excel\Writer\Common\Creator;

use Rocky114\Excel\Common\Entity\Cell;
use Rocky114\Excel\Common\Entity\Row;
use Rocky114\Excel\Common\Entity\Style\Style;
use Rocky114\Excel\Common\Exception\UnsupportedTypeException;
use Rocky114\Excel\Common\Creator\HelperFactory;
use Rocky114\Excel\Common\Helper\GlobalFunctionsHelper;
use Rocky114\Excel\Writer\Common\Creator\Style\StyleBuilder;
use Rocky114\Excel\Writer\CSV\Manager\OptionsManager as CSVOptionsManager;
use Rocky114\Excel\Writer\CSV\Writer as CSVWriter;
use Rocky114\Excel\Writer\XLSX\Creator\HelperFactory as XLSXHelperFactory;
use Rocky114\Excel\Writer\XLSX\Creator\ManagerFactory as XLSXManagerFactory;
use Rocky114\Excel\Writer\XLSX\Manager\OptionsManager as XLSXOptionsManager;
use Rocky114\Excel\Writer\XLSX\Writer as XLSXWriter;

/**
 * Class WriterEntityFactory
 * Factory to create external entities
 */
class WriterEntityFactory
{
    /**
     * This creates an instance of a CSV writer
     *
     * @return \Rocky114\Excel\Writer\CSV\Writer
     */
    public static function createCSVWriter()
    {
        try {
            $optionsManager = new CSVOptionsManager();
            $globalFunctionsHelper = new GlobalFunctionsHelper();

            $helperFactory = new HelperFactory();

            return new CSVWriter($optionsManager, $globalFunctionsHelper, $helperFactory);
        } catch (UnsupportedTypeException $e) {
            // should never happen
        }
    }

    /**
     * This creates an instance of a XLSX writer
     *
     * @return \Rocky114\Excel\Writer\XLSX\Writer
     */
    public static function createXLSXWriter()
    {
        try {
            $styleBuilder = new StyleBuilder();
            $optionsManager = new XLSXOptionsManager($styleBuilder);
            $globalFunctionsHelper = new GlobalFunctionsHelper();

            $helperFactory = new XLSXHelperFactory();
            $managerFactory = new XLSXManagerFactory(new InternalEntityFactory(), $helperFactory);

            return new XLSXWriter($optionsManager, $globalFunctionsHelper, $helperFactory, $managerFactory);
        } catch (UnsupportedTypeException $e) {
            // should never happen
        }
    }

    /**
     * @param Cell[] $cells
     * @param Style|null $rowStyle
     * @return Row
     */
    public static function createRow(array $cells = [], Style $rowStyle = null)
    {
        return new Row($cells, $rowStyle);
    }

    /**
     * @param array $cellValues
     * @param Style|null $rowStyle
     * @return Row
     */
    public static function createRowFromArray(array $cellValues = [], Style $rowStyle = null)
    {
        $cells = \array_map(function ($cellValue) {
            return new Cell($cellValue);
        }, $cellValues);

        return new Row($cells, $rowStyle);
    }

    /**
     * @param mixed $cellValue
     * @param Style|null $cellStyle
     * @return Cell
     */
    public static function createCell($cellValue, Style $cellStyle = null)
    {
        return new Cell($cellValue, $cellStyle);
    }
}
