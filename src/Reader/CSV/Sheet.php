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
     * @return Row
     */
    public function getRowIterator()
    {
        $this->rowHandle = new Row($this->fileHandle);

        return $this->rowHandle;
    }

    /**
     * @return array
     */
    public function load()
    {
        $rows = [];
        foreach ($this->getRowIterator() as $row) {
            $rows[] = $row;
        }

        return $rows;
    }
}