<?php

namespace Rocky114\Excel\Writer\XLSX;

class Cell
{
    protected $value;

    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function getCellXml()
    {
        return $this->value;
    }

    public function setCellXml($value)
    {
        $this->value = $value;

        return $this;
    }
}