<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderInterface;
use Rocky114\Spreadsheet\Reader\XLSX\XMLReader;

class Reader implements ReaderInterface
{
    protected $readerHandle;
    protected $sheetHandle;

    public function __construct($filePath)
    {
        $this->readerHandle = new XMLReader($filePath);
    }

    public function open()
    {
        $this->readerHandle->readContentTypeXML();
        $this->readerHandle->readShareStringXML();

        $this->sheetHandle = new Sheet($this->readerHandle);
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\XLSX\Sheet
     */
    public function getSheetIterator()
    {
        return $this->sheetHandle;
    }

    public function getSheet(int $index)
    {

    }

    public function close()
    {

    }
}