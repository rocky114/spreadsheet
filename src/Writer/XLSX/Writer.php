<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\Helper;

class Writer
{
    protected static $headerContentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    protected $fileHandle;

    protected $functionHelper;

    protected $outputFilename;

    public function __construct(Helper $helper)
    {
        $this->functionHelper = $helper;
    }

    public function openToFile($filename, $dir)
    {

    }

    public function openToBrowser($filename)
    {
        if (!$this->functionHelper->isXLSXFile($filename)) {
            throw new \Exception('filename extension error');
        }

        $this->outputFilename = $filename;

        $this->functionHelper->flushBuffer();

        $this->fileHandle = fopen('php://output', 'w');

        header('Content-Type: ' . self::$headerContentType);
        header('Content-Disposition: attachment; filename="' . $this->outputFilename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        return $this;
    }
}