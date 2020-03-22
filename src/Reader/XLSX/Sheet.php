<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Sheet implements \Iterator
{
    protected $index = 0;
    protected $sheets = [];

    protected $rowHandle;

    /**
     * Sheet constructor.
     * @param XMLReader $reader
     */
    public function __construct(XMLReader $reader)
    {
        $this->rowHandle = new Row($reader);
        $this->sheets = $reader->getSheets();
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
     * @param array $columns
     * @return Row
     */
    public function getRowIterator($columns = ['*'])
    {
        $this->rowHandle->setSheetFile($this->sheets[$this->index]);
        $this->rowHandle->setColumns($columns);

        return $this->rowHandle;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function load($columns = ['*'])
    {
        $rows = [];
        foreach ($this->getRowIterator($columns) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @param int $index
     * @return $this
     * @throws \Exception
     */
    public function setIndex(int $index)
    {
        if (!isset($this->sheets[$index])) {
            throw new \Exception('sheets index 0 does not exist');
        }

        $this->index = $index;

        return $this;
    }
}