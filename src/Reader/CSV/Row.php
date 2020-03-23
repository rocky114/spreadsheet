<?php

namespace Rocky114\Spreadsheet\Reader\CSV;

use Rocky114\Spreadsheet\FileFactory;

class Row implements \Iterator
{
    protected $columns = [];
    protected $indexes = [];
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
        if (!empty($this->columns)) {
            $data = [];
            foreach ($this->row as $index => $item) {
                if (in_array($index, $this->indexes, true)) {
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

        if (!empty($this->columns)) {
            foreach ($this->columns as $column) {
                $this->indexes[] = getSheetHeaderIndex($column);
            }
        }
    }

    public function setColumns(array $column = [])
    {
        $this->columns = $column;
    }
}