<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderInterface;

class Reader implements ReaderInterface
{
    protected $isShareString = false;
    protected $readerHandle;
    protected $sheets = [];

    public function __construct($filePath)
    {
    }

    public function open()
    {
        $this->parseContentType();
    }

    public function parseContentType()
    {

    }

    public function getSheetIterator()
    {

    }

    public function getSheetByIndex(int $index)
    {

    }

    public function getSheetByName(string $name)
    {

    }

    public function close()
    {

    }
}