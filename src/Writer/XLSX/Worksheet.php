<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;

class Worksheet
{
    private $sheetName;

    protected $filename;

    public function __construct($name)
    {
        $this->sheetName = $name;
        $this->filename = FunctionHelper::createUniqueId();
    }

    public function addRow()
    {

    }

    public function addRows()
    {

    }

    public function getSheetName()
    {
        return $this->sheetName;
    }
}