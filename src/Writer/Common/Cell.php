<?php

namespace Rocky114\Excel\Writer\Common;

class Cell
{
    protected $value;

    protected $style;

    public function __construct($vale, $style = null)
    {

    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }
}