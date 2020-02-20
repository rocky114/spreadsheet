<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Common\ZipHelper;
use Rocky114\Excel\Writer\XLSX\Style\Style;

class Writer
{
    protected $fileHandle;

    protected $zipHelper;
    protected $workbook;

    protected $options = [];

    public function __construct(array $config = [])
    {
        $this->options = [
            'temp_folder' => sys_get_temp_dir(),
            'debug'       => false,
            'filename'    => 'excel.xlsx'
        ];

        $this->options = array_merge($this->options, $config);
        $this->options['temp_folder'] = realpath(trim($this->options['temp_folder'], '/')) . DIRECTORY_SEPARATOR;

        $this->workbook = new Workbook($this->options);
    }

    public function addNewSheet($name)
    {
        $this->workbook->addNewSheet($name);
    }

    public function addHeader(array $header, array $formats = [])
    {
        $this->workbook->getCurrentSheet()->addHeader($header, $formats);
    }

    public function addRow(array $row = [])
    {
        $this->workbook->getCurrentSheet()->addRow($row);
    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function openToFile($filename, $dir)
    {

    }

    public function openToBrowser()
    {
        if (ob_get_length() > 0) {
            ob_end_clean();
        }

        $this->fileHandle = fopen('php://output', 'w');

        header('Content-Type: ' . 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->options['filename'] . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        return $this;
    }

    public function getWorkbook()
    {
        return $this->workbook;
    }

    public function close()
    {
        $this->zipHelper = new ZipHelper($this->workbook);
        $this->zipHelper->writeToZipArchive();
    }
}