<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderInterface;

/**
 * Class Reader
 * @property \Rocky114\Spreadsheet\Reader\XLSX\Sheet $sheetHandle
 * @property  \Rocky114\Spreadsheet\Reader\XLSX\XMLReader $readerHandle
 */
class Reader implements ReaderInterface
{
    protected $readerHandle;
    protected $sheetHandle;

    /**
     * @param $path
     * @throws \Exception
     */
    public function open(string $path)
    {
        $path = realpath($path);
        if (!file_exists($path)) {
            throw new \Exception("Could not open $path for reading! File does not exist.");
        }
        if (!is_readable($path)) {
            throw new \Exception("Could not open $path for reading! File is not readable.");
        }

        $this->readerHandle = new XMLReader($path);

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

    /**
     * @param int $index
     * @return Sheet
     * @throws \Exception
     */
    public function getSheet(int $index = 0)
    {
        return $this->sheetHandle->setIndex($index);
    }

    public function close()
    {

    }
}