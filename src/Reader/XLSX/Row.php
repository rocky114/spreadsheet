<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class Row implements \Iterator
{
    protected $columns = [];

    public function __construct()
    {
    }

    public function current()
    {

    }

    public function next()
    {

    }

    public function key()
    {

    }

    public function valid()
    {

    }

    public function rewind()
    {

    }

    public function setReadColumns(array $column = [])
    {
        $this->columns = $column;
    }
}