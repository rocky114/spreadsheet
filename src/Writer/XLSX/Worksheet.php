<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;

class Worksheet
{
    private $sheetName;

    protected $filename;

    protected $fileHandle;

    public function __construct($sheetName, $config = [])
    {
        $this->sheetName = $sheetName;
        $this->filename = FunctionHelper::createUniqueId();

        $filePath = realpath(trim($config['temp_folder'], '/')) . DIRECTORY_SEPARATOR . $sheetName;
        $this->fileHandle = new FileHelper($filePath);
    }

    public function addRow(array $row = [])
    {

    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    public function setStyle()
    {

    }

    public function getSheetName()
    {
        return $this->sheetName;
    }
}