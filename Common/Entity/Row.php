<?php

namespace Rocky114\Excel\Common\Entity;

use Rocky114\Excel\Common\Entity\Style\Style;

class Row
{
    protected $cells = [];

    protected $style;

    public function __construct(array $cells, $style)
    {
        $this->setCells($cells)->setStyle($style);
    }

    public function getCells()
    {
        return $this->cells;
    }

    public function setCells(array $cells)
    {
        $this->cells = [];

        foreach ($cells as $cell) {
            $this->addCell($cell);
        }

        return $this;
    }

    public function setCellAtIndex(Cell $cell, $index)
    {
        $this->cells[$index] = $cell;
    }

    public function getCellAtIndex($index)
    {
        return $this->cells[$index] ?? null;
    }

    public function addCell(Cell $cell)
    {
        $this->cells[] = $cell;

        return $this;
    }

    public function getNumCells()
    {
        if (empty($this->cells)) {
            return 0;
        }

        return count($this->cells);
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style)
    {
        $this->style = $style ?: new Style();

        return $this;
    }

    public function toArray()
    {
        return array_map(function (Cell $cell) {
            return $cell->getValue();
        }, $this->cells);
    }
}