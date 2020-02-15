<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;

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

    protected $rowHandle;

    protected $lastWrittenRowIndex = 0;

    protected $workbook;

    public function __construct($id, $name, Workbook $workbook)
    {
        $this->id = $id;
        $this->name = $name;
        $this->workbook = $workbook;

        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->filePath = $workbook->temp_folder. $name;
        $this->fileHandle = new FileHelper($this->filePath);

        $this->cellHandle = new Cell($this->typeHandle);

        $this->rowHandle = new Row($this->typeHandle);

        $this->startSheet();
    }

    public function addRow(array $row = [])
    {
        $this->lastWrittenRowIndex++;

        $rowXML = '<row r="'.$this->lastWrittenRowIndex.'">';

        $rowXML .= $this->rowHandle->setCells($this->lastWrittenRowIndex, $row)->getRowXML();

        $rowXML .= '</row>';

        $this->fileHandle->write($rowXML);

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
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
    <sheetData>
HTML;

        $this->fileHandle->write($html);
    }

    protected function closeSheet()
    {
        $html = <<<HTML
    </sheetData>
</worksheet>
HTML;

        $this->fileHandle->write($html);
        $this->fileHandle->close();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Style
     */
    public function getStyle()
    {
        if ($this->styleHandle === null) {
            $this->styleHandle = new Style($this->workbook);
        }

        return $this->styleHandle;
    }
}