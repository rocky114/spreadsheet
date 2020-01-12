<?php

namespace Rocky114\Excel\Writer\Common\Creator;

use Rocky114\Excel\Common\Manager\OptionsManagerInterface;
use Rocky114\Excel\Writer\Common\Manager\SheetManager;
use Rocky114\Excel\Writer\Common\Manager\WorkbookManagerInterface;

/**
 * Interface ManagerFactoryInterface
 */
interface ManagerFactoryInterface
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @return WorkbookManagerInterface
     */
    public function createWorkbookManager(OptionsManagerInterface $optionsManager);

    /**
     * @return SheetManager
     */
    public function createSheetManager();
}
