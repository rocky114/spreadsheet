<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Sheet implements \Iterator
{
    protected $index = 0;
    protected $sheets = [];

    protected $readerHandle;
    protected $rowHandle;

    /**
     * Sheet constructor.
     * @param XMLReader $reader
     */
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

    /**
     * @return Row
     */
    public function getRowIterator()
    {
        $this->rowHandle = new Row($this->readerHandle);
        $this->rowHandle->setSheetFile($this->sheets[$this->index]);

        return $this->rowHandle;
    }

    /**
     * @param int $index
     * @return array
     * @throws \Exception
     */
    public function load(int $index)
    {
        if (!isset($this->sheets[$index])) {
            throw new \Exception('sheets index 0 does not exist');
        }

        $this->index = $index;

        $rows = [];
        foreach ($this->getRowIterator() as $row) {
            $rows[] = $row;
        }

        return $rows;
    }
}