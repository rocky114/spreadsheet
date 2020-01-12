<?php

namespace Rocky114\Excel\Writer\XLSX\Creator;

use Rocky114\Excel\Common\Helper\Escaper\XLSX;
use Rocky114\Excel\Common\Helper\StringHelper;
use Rocky114\Excel\Common\Manager\OptionsManagerInterface;
use Rocky114\Excel\Writer\Common\Creator\InternalEntityFactory;
use Rocky114\Excel\Writer\Common\Entity\Options;
use Rocky114\Excel\Writer\Common\Helper\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Helper\FileSystemHelper;
use Rocky114\Excel\Common\Creator\HelperFactory as CommonHelpFactory;

/**
 * Class HelperFactory
 * Factory for helpers needed by the XLSX Writer
 */
class HelperFactory extends CommonHelpFactory
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @param InternalEntityFactory $entityFactory
     * @return FileSystemHelper
     */
    public function createSpecificFileSystemHelper(OptionsManagerInterface $optionsManager, InternalEntityFactory $entityFactory)
    {
        $tempFolder = $optionsManager->getOption(Options::TEMP_FOLDER);
        $zipHelper = $this->createZipHelper($entityFactory);
        $escaper = $this->createStringsEscaper();

        return new FileSystemHelper($tempFolder, $zipHelper, $escaper);
    }

    /**
     * @param InternalEntityFactory $entityFactory
     * @return ZipHelper
     */
    private function createZipHelper(InternalEntityFactory $entityFactory)
    {
        return new ZipHelper($entityFactory);
    }

    /**
     * @return Rocky114\Excel\Common\Helper\Escaper\XLSX
     */
    public function createStringsEscaper()
    {
        return new XLSX();
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
