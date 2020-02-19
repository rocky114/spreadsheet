<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Font
{
    protected $name = 'Calibri';
    protected $size = 11;
    protected $bold = false;

    protected $coordinate;

    public function __construct($coordinate)
    {
        $this->coordinate = $coordinate;
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

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getBold()
    {
        return $this->bold;
    }
}