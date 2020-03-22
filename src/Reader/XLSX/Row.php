<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Row implements \Iterator
{
    protected $columns = ['*'];
    protected $columnIndex = [];
    protected $file;

    protected $readerHandle;

    protected $cellType;
    protected $rowNumber = 0;

    protected $eof = false;

    public function __construct(XMLReader $reader)
    {
        $this->readerHandle = $reader;
    }

    public function current()
    {
        $row = [];
        $i = 0;

        while ($this->readerHandle->read()) {
            $element = $this->readerHandle->name;
            $type = $this->readerHandle->nodeType;

            if ($element === 'row' && $type === $this->readerHandle::END_ELEMENT) {
                break;
            }

            $element === 'c' && $this->cellType = $this->readerHandle->getAttribute('t');

            if ($element === '#text') {
                if ($this->columns[0] !== '*' && !in_array($i, $this->columnIndex, true)) {
                    continue;
                }

                $value = $this->readerHandle->value;
                $row[$i] = $this->cellType === 's' ? $this->readerHandle->getShareStringByIndex($value) : $value;
            }

            $i++;
        }

        return $row;
    }

    public function next()
    {
        $this->rowNumber++;

        while ($this->readerHandle->read()) {
            $element = $this->readerHandle->name;
            $type = $this->readerHandle->nodeType;

            if ($element === 'row' && $type === $this->readerHandle::ELEMENT) {
                break;
            }

            if ($element === 'sheetData' && $type === $this->readerHandle::END_ELEMENT) {
                $this->eof = true;
            }
        }
    }

    public function key()
    {
        return $this->rowNumber;
    }

    public function valid()
    {
        if ($this->eof) {
            $this->readerHandle->close();
        }

        return !$this->eof;
    }

    /**
     * @throws \Exception
     */
    public function rewind()
    {
        $this->eof = false;
        $this->rowNumber = 0;

        if (false === $this->readerHandle->open("zip://{$this->readerHandle->filePath}#{$this->file}")) {
            throw new \Exception("Could not open {$this->file} for reading! File does not exist.");
        }

        while ($this->readerHandle->read()) {
            $element = $this->readerHandle->name;
            $type = $this->readerHandle->nodeType;

            if ($element === 'row' && $type === $this->readerHandle::ELEMENT) {
                break;
            }
        }

        if ($this->columns[0] !== '*') {
            foreach ($this->columns as $column) {
                $this->columnIndex[] = getSheetHeaderIndex($column);
            }
        }
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns = ['*'])
    {
        $this->columns = $columns;
    }

    public function setSheetFile($file)
    {
        $this->file = $file;
    }
}