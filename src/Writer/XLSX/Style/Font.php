<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Font
{
    protected $name = 'Calibri';
    protected $size = 11;
    protected $bold = false;

    public function __construct()
    {

    }

    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    public function setBold(bool $boolean)
    {
        $this->bold = $boolean;

        return $this;
    }
}