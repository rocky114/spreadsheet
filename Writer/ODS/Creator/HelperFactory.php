<?php

namespace Rocky114\Excel\Writer\ODS\Creator;

use Rocky114\Excel\Common\Helper\Escaper;
use Rocky114\Excel\Common\Helper\StringHelper;
use Rocky114\Excel\Common\Manager\OptionsManagerInterface;
use Rocky114\Excel\Writer\Common\Creator\InternalEntityFactory;
use Rocky114\Excel\Writer\Common\Entity\Options;
use Rocky114\Excel\Writer\Common\Helper\ZipHelper;
use Rocky114\Excel\Writer\ODS\Helper\FileSystemHelper;

/**
 * Class HelperFactory
 * Factory for helpers needed by the ODS Writer
 */
class HelperFactory extends \Rocky114\Excel\Common\Creator\HelperFactory
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

        return new FileSystemHelper($tempFolder, $zipHelper);
    }

    /**
     * @param $entityFactory
     * @return ZipHelper
     */
    private function createZipHelper($entityFactory)
    {
        return new ZipHelper($entityFactory);
    }

    /**
     * @return Escaper\ODS
     */
    public function createStringsEscaper()
    {
        return new Escaper\ODS();
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
