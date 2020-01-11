<?php

namespace Rocky114\Excel\Writer\Common\Manager;

use Rocky114\Excel\Common\Entity\Cell;
use Rocky114\Excel\Common\Entity\Style\Style;
use Rocky114\Excel\Writer\Common\Manager\Style\StyleMerger;

class CellManager
{
    /**
     * @var StyleMerger
     */
    protected $styleMerger;

    /**
     * @param StyleMerger $styleMerger
     */
    public function __construct(StyleMerger $styleMerger)
    {
        $this->styleMerger = $styleMerger;
    }

    /**
     * Merges a Style into a cell's Style.
     *
     * @param Cell $cell
     * @param Style $style
     * @return void
     */
    public function applyStyle(Cell $cell, Style $style)
    {
        $mergedStyle = $this->styleMerger->merge($cell->getStyle(), $style);
        $cell->setStyle($mergedStyle);
    }
}
