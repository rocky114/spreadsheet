<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Common\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Workbook;

class Writer
{
    protected static $headerContentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    protected $fileHandle;

    protected $functionHelper;
    protected $zipHelper;
    protected $workbook;

    protected $outputFilename;

    public function __construct(FunctionHelper $functionHelper, ZipHelper $zipHelper, Workbook $workbook)
    {
        $this->functionHelper = $functionHelper;
        $this->zipHelper = $zipHelper;
        $this->workbook = $workbook;
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

    public function closeWriter()
    {
        $this->zipHelper->
    }


}