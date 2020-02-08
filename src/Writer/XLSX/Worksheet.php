<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;

class Worksheet
{
    private $sheetName;

    protected $filename;

    protected $fileHandle;

    protected $styleHandle;

    protected $typeHandle;

    public function __construct($sheetName, $config = [])
    {
        $this->sheetName = $sheetName;
        $this->filename = FunctionHelper::createUniqueId();

        $filePath = realpath(trim($config['temp_folder'], '/')) . DIRECTORY_SEPARATOR . $sheetName;
        $this->fileHandle = new FileHelper($filePath);
    }

    public function addRow(array $row = [])
    {
        $content = '';

        $this->fileHandle->write($content);

        return $this;
    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function getStyle()
    {
        $this->styleHandle = new Style\Style();

        return $this->styleHandle;
    }

    public function setColumnType($types = [])
    {
        $this->typeHandle = new Type($types);

        return $this;
    }

    public function getSheetName()
    {
        return $this->sheetName;
    }
}