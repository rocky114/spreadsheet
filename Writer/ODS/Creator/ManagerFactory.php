<?php

namespace Rocky114\Excel\Writer\ODS\Creator;

use Rocky114\Excel\Common\Manager\OptionsManagerInterface;
use Rocky114\Excel\Writer\Common\Creator\InternalEntityFactory;
use Rocky114\Excel\Writer\Common\Creator\ManagerFactoryInterface;
use Rocky114\Excel\Writer\Common\Entity\Options;
use Rocky114\Excel\Writer\Common\Manager\SheetManager;
use Rocky114\Excel\Writer\Common\Manager\Style\StyleMerger;
use Rocky114\Excel\Writer\ODS\Manager\Style\StyleManager;
use Rocky114\Excel\Writer\ODS\Manager\Style\StyleRegistry;
use Rocky114\Excel\Writer\ODS\Manager\WorkbookManager;
use Rocky114\Excel\Writer\ODS\Manager\WorksheetManager;

/**
 * Class ManagerFactory
 * Factory for managers needed by the ODS Writer
 */
class ManagerFactory implements ManagerFactoryInterface
{
    /** @var InternalEntityFactory */
    protected $entityFactory;

    /** @var HelperFactory $helperFactory */
    protected $helperFactory;

    /**
     * @param InternalEntityFactory $entityFactory
     * @param HelperFactory $helperFactory
     */
    public function __construct(InternalEntityFactory $entityFactory, HelperFactory $helperFactory)
    {
        $this->entityFactory = $entityFactory;
        $this->helperFactory = $helperFactory;
    }

    /**
     * @param OptionsManagerInterface $optionsManager
     * @return WorkbookManager
     */
    public function createWorkbookManager(OptionsManagerInterface $optionsManager)
    {
        $workbook = $this->entityFactory->createWorkbook();

        $fileSystemHelper = $this->helperFactory->createSpecificFileSystemHelper($optionsManager, $this->entityFactory);
        $fileSystemHelper->createBaseFilesAndFolders();

        $styleMerger = $this->createStyleMerger();
        $styleManager = $this->createStyleManager($optionsManager);
        $worksheetManager = $this->createWorksheetManager($styleManager, $styleMerger);

        return new WorkbookManager(
            $workbook,
            $optionsManager,
            $worksheetManager,
            $styleManager,
            $styleMerger,
            $fileSystemHelper,
            $this->entityFactory,
            $this
        );
    }

    /**
     * @param StyleManager $styleManager
     * @param StyleMerger $styleMerger
     * @return WorksheetManager
     */
    private function createWorksheetManager(StyleManager $styleManager, StyleMerger $styleMerger)
    {
        $stringsEscaper = $this->helperFactory->createStringsEscaper();
        $stringsHelper = $this->helperFactory->createStringHelper();

        return new WorksheetManager($styleManager, $styleMerger, $stringsEscaper, $stringsHelper);
    }

    /**
     * @return SheetManager
     */
    public function createSheetManager()
    {
        $stringHelper = $this->helperFactory->createStringHelper();

        return new SheetManager($stringHelper);
    }

    /**
     * @param OptionsManagerInterface $optionsManager
     * @return StyleManager
     */
    private function createStyleManager(OptionsManagerInterface $optionsManager)
    {
        $styleRegistry = $this->createStyleRegistry($optionsManager);

        return new StyleManager($styleRegistry);
    }

    /**
     * @param OptionsManagerInterface $optionsManager
     * @return StyleRegistry
     */
    private function createStyleRegistry(OptionsManagerInterface $optionsManager)
    {
        $defaultRowStyle = $optionsManager->getOption(Options::DEFAULT_ROW_STYLE);

        return new StyleRegistry($defaultRowStyle);
    }

    /**
     * @return StyleMerger
     */
    private function createStyleMerger()
    {
        return new StyleMerger();
    }
}
