<?php

namespace Rocky114\Excel\Common\Creator;

use Rocky114\Excel\Common\Helper\EncodingHelper;
use Rocky114\Excel\Common\Helper\FileSystemHelper;
use Rocky114\Excel\Common\Helper\GlobalFunctionsHelper;
use Rocky114\Excel\Common\Helper\StringHelper;

/**
 * Class HelperFactory
 * Factory to create helpers
 */
class HelperFactory
{
    /**
     * @return GlobalFunctionsHelper
     */
    public function createGlobalFunctionsHelper()
    {
        return new GlobalFunctionsHelper();
    }

    /**
     * @param string $baseFolderPath The path of the base folder where all the I/O can occur
     * @return FileSystemHelper
     */
    public function createFileSystemHelper($baseFolderPath)
    {
        return new FileSystemHelper($baseFolderPath);
    }

    /**
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return EncodingHelper
     */
    public function createEncodingHelper(GlobalFunctionsHelper $globalFunctionsHelper)
    {
        return new EncodingHelper($globalFunctionsHelper);
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
