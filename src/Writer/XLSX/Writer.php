<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Common\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Workbook;
use Rocky114\Excel\Writer\XLSX\Type;
use Rocky114\Excel\Writer\XLSX\Style\Style;

class Writer
{
    protected static $headerContentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    protected $fileHandle;

    protected $zipHelper;
    protected $workbook;

    protected $outputFilename;

    protected $columnType;

    public function __construct()
    {
        $this->zipHelper = new ZipHelper();
        $this->workbook = new Workbook();
    }

    public function openToFile($filename, $dir)
    {

    }

    public function openToBrowser($filename)
    {
        if (FunctionHelper::isXLSXFile($filename)) {
            throw new \Exception('filename extension error');
        }

        $this->outputFilename = $filename;

        functionHelper::flushBuffer();

        $this->fileHandle = fopen('php://output', 'w');

        header('Content-Type: ' . self::$headerContentType);
        header('Content-Disposition: attachment; filename="' . $this->outputFilename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        return $this;
    }

    public function addRow()
    {

    }

    public function addRows()
    {

    }

    public function addSheet()
    {

    }

    public function close()
    {
        $this->zipHelper->writeToZipArchive($this->workbook);
    }

    public function setTempFolder($dir = null)
    {
        $dir = $dir === null ? sys_get_temp_dir() : $dir;

        return $this;
    }

    public function setColumnType(Type $type)
    {
        $this->columnType = $type;
        return $this;
    }

    public function getCurrentSheet()
    {

    }

    public function setCurrentSheet()
    {

    }
}