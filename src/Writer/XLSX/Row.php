<?php

namespace Rocky114\Excel\Writer\XLSX;

class Row
{
    protected $cells = [];

    protected $type;

    public function __construct(array $cells)
    {

    }

    public function getCells()
    {
        return $this->cells;
    }

    public function getType()
    {

    }

    public function getStyle()
    {

    }

    public function setCells($cells)
    {
        $this->cells = $cells;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}