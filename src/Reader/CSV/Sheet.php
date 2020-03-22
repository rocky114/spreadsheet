<?php

namespace Rocky114\Spreadsheet\Reader\CSV;

use Rocky114\Spreadsheet\FileFactory;

class Sheet implements \Iterator
{
    protected $index = 0;

    protected $fileHandle;
    protected $rowHandle;

    /**
     * Sheet constructor.
     * @param FileFactory $fileHandle
     */
    public function __construct(FileFactory $fileHandle)
    {
        $this->fileHandle = $fileHandle;
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\CSV\Sheet
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
        return $this->index > 0;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * @param array $columns
     * @return Row
     */
    public function getRowIterator(array $columns = ['*'])
    {
        $this->rowHandle = new Row($this->fileHandle);
        $this->rowHandle->setColumns($columns);

        return $this->rowHandle;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function load(array $columns = ['*'])
    {
        $rows = [];
        foreach ($this->getRowIterator($columns) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }
}