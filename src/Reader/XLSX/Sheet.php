<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Sheet implements \Iterator
{
    protected $index = 0;
    protected $sheets = [];

    protected $readerHandle;
    protected $rowHandle;

    public function __construct(XMLReader $reader)
    {
        $this->readerHandle = $reader;
        $this->sheets = $this->readerHandle->getSheets();
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\XLSX\Sheet
     */
    public function current()
    {
        return $this;
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return isset($this->sheets[$this->index]);
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function getRowIterator()
    {
        $this->rowHandle = new Row($this->readerHandle);
        $this->rowHandle->setSheetFile($this->sheets[$this->index]);

        return $this->rowHandle;
    }
}