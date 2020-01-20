<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Writer\XLSX\Sheet;

class Worksheet
{
    private $filePath;

    private $fileHandle;

    public function __construct($filePath, Sheet $sheet)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getCurrentSheet()
    {

    }

    public function addNewSheet()
    {
        
    }
}