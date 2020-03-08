<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use \XMLReader;

class ShareString
{
    protected $strings = [];

    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function parseShareString()
    {
        $readerHandle = new XMLReader();

        if (false === $readerHandle->open("zip://{$this->path}#xl/sharedStrings.xml")) {
            throw new \Exception('Could not open xl/sharedStrings.xml for reading! File does not exist.');
        }

        while ($readerHandle->read()) {
            if ($readerHandle->name === '#text') {
                $this->strings[] = $readerHandle->value;
            }
        }

        $readerHandle->close();
    }

    public function getStringByIndex($index)
    {
        return $this->strings[$index];
    }
}