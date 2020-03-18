<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Row implements \Iterator
{
    protected $columns = [];
    protected $file;

    protected $readerHandle;

    protected $hasReachedEndOfFile = false;

    protected $rowNumber = 0;

    protected $rowStart = false;
    protected $rowEnd = false;

    protected $cellType;
    protected $maxRow;

    public function __construct(XMLReader $reader)
    {
        $this->readerHandle = $reader;
    }

    public function current()
    {
        $row = [];
        while ($this->readerHandle->read()) {
            $element = $this->readerHandle->name;
            $type = $this->readerHandle->nodeType;

            if ($element === 'row') {
                $this->rowStart = $type === $this->readerHandle::ELEMENT ? true : false;
                $this->rowEnd = $type === $this->readerHandle::END_ELEMENT ? true : false;
            }

            if ($this->rowEnd) {
                break;
            }

            if (!$this->rowStart) {
                continue;
            }

            $element === 'c' && $this->cellType = $this->readerHandle->getAttribute('t');

            if ($element === '#text') {
                $value = $this->readerHandle->value;
                $row[] = $this->cellType === 's' ? $this->readerHandle->getShareStringByIndex($value) : $value;
            }
        }

        return $row;
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
        $isValid = $this->rowNumber < $this->maxRow;
        if (!$isValid) {
            $this->readerHandle->close();
        }

        return $isValid;
    }

    public function rewind()
    {
        if (false === $this->readerHandle->open("zip://{$this->readerHandle->filePath}#{$this->file}")) {
            throw new \Exception("Could not open {$this->file} for reading! File does not exist.");
        }

        while ($this->readerHandle->read()) {
            $element = $this->readerHandle->name;

            if ($element === 'dimension') {
                $dimension = $this->readerHandle->getAttribute('ref');
                $arr = explode(':', $dimension);
                $this->maxRow = str_replace(range('A', 'Z'), '', $arr[1]);

                break;
            }
        }
    }

    public function setReadColumns(array $column = [])
    {
        $this->columns = $column;
    }

    public function setSheetFile($file)
    {
        $this->file = $file;
    }
}