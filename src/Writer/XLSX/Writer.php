<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Common\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Style\Style;

class Writer
{
    protected static $headerContentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    protected $fileHandle;

    protected $zipHelper;
    protected $workbook;

    protected $columnType;

    protected $options = [];

    public function __construct(array $config = [])
    {
        $this->options = [
            'temp_folder' => sys_get_temp_dir(),
            'style'       => new Style(),
            'debug'       => false,
            'filename'    => 'excel.xlsx'
        ];

        $this->options = array_merge($this->options, $config);

        $this->workbook = new Workbook($this->options);
    }

    public function openToFile($filename, $dir)
    {

    }

    public function openToBrowser()
    {
        functionHelper::flushBuffer();

        $this->fileHandle = fopen('php://output', 'w');

        header('Content-Type: ' . 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->options['filename'] . '"');
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

    public function setColumnType(Type $type, Sheet $sheet = null)
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

    public function setStyle()
    {

    }

    public function close()
    {
        $this->zipHelper = new ZipHelper($this->workbook);
        $this->zipHelper->writeToZipArchive();
    }
}