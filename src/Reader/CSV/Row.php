<?php

namespace Rocky114\Spreadsheet\Reader\CSV;

class Row implements \Iterator
{
    protected $columns = [];
    protected $row = [];
    protected $rowNumber = 0;

    protected $fileHandle;

    /**
     * Row constructor.
     * @param resource $fileHandle
     */
    public function __construct($fileHandle)
    {
        $this->fileHandle = $fileHandle;
    }

    public function current()
    {
        return $this->row;
    }

    public function next()
    {
        $this->rowNumber++;
    }

    public function key()
    {
        return $this->rowNumber;
    }

    public function valid()
    {
        return ($this->row = fgetcsv($this->fileHandle)) === false;
    }

    public function rewind()
    {
        $this->rowNumber = 0;
        $this->row = [];
    }

    public function setReadColumns(array $column = [])
    {
        $this->columns = $column;
    }
}