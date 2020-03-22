<?php

namespace Rocky114\Spreadsheet\Reader\CSV;

use Rocky114\Spreadsheet\FileFactory;

class Row implements \Iterator
{
    protected $columns = [];
    protected $columnIndex = [];
    protected $row = [];
    protected $rowNumber = 0;

    protected $fileHandle;

    /**
     * Row constructor.
     * @param FileFactory $fileHandle
     */
    public function __construct(FileFactory $fileHandle)
    {
        $this->fileHandle = $fileHandle;
    }

    public function current()
    {
        if ($this->columns[0] !== '*') {
            $data = [];
            foreach ($this->row as $index => $item) {
                if (in_array($index, $this->columnIndex, true)) {
                    $data[] = $item;
                }
            }

            return $data;
        } else {
            return $this->row;
        }
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
        $this->row = $this->fileHandle->getCsv();

        return $this->row !== null && $this->row !== false;
    }

    public function rewind()
    {
        $this->rowNumber = 0;
        $this->row = [];

        if ($this->columns[0] !== '*') {
            foreach ($this->columns as $column) {
                $this->columnIndex[] = getSheetHeaderIndex($column);
            }
        }
    }

    public function setColumns(array $column = ['*'])
    {
        $this->columns = $column;
    }
}