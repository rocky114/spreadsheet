<?php

namespace Rocky114\Excel\Reader\ODS\Creator;

use Rocky114\Excel\Reader\ODS\Helper\CellValueFormatter;
use Rocky114\Excel\Reader\ODS\Helper\SettingsHelper;

/**
 * Class HelperFactory
 * Factory to create helpers
 */
class HelperFactory extends \Rocky114\Excel\Common\Creator\HelperFactory
{
    /**
     * @param bool $shouldFormatDates Whether date/time values should be returned as PHP objects or be formatted as strings
     * @return CellValueFormatter
     */
    public function createCellValueFormatter($shouldFormatDates)
    {
        $escaper = $this->createStringsEscaper();

        return new CellValueFormatter($shouldFormatDates, $escaper);
    }

    /**
     * @param InternalEntityFactory $entityFactory
     * @return SettingsHelper
     */
    public function createSettingsHelper($entityFactory)
    {
        return new SettingsHelper($entityFactory);
    }

    /**
     * @return \Rocky114\Excel\Common\Helper\Escaper\ODS
     */
    public function createStringsEscaper()
    {
        /* @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        return new \Rocky114\Excel\Common\Helper\Escaper\ODS();
    }
}
