<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;
//use Rocky114\Excel\Writer\XLSX\Cell;

class Worksheet
{
    public $id;

    public $name;

    public $filename;

    public $filePath;

    protected $fileHandle;

    protected $styleHandle;

    protected $typeHandle;

    protected $cellHandle;

    const SHEET_XML_FILE_HEADER = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
HTML;

    public function __construct($id, $name, $config = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->filePath = realpath(trim($config['temp_folder'], '/')) . DIRECTORY_SEPARATOR . $name;
        $this->fileHandle = new FileHelper($this->filePath);

        $this->cellHandle = new Cell($this->typeHandle);

        $this->startSheet();
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

    public function setColumnType($types = [])
    {
        $this->typeHandle = new Type($types);

        return $this;
    }

    protected function startSheet()
    {
        $this->fileHandle->write(self::SHEET_XML_FILE_HEADER);
        $this->fileHandle->write('<sheetData>');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStyle()
    {
        $this->styleHandle = new Style\Style();

        return $this->styleHandle;
    }
}