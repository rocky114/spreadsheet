<?php

namespace Rocky114\Excel\Writer\Common\Manager\Style;

use Rocky114\Excel\Common\Entity\Cell;
use Rocky114\Excel\Common\Entity\Style\Style;

/**
 * Interface StyleHManagernterface
 */
interface StyleManagerInterface
{
    /**
     * Registers the given style as a used style.
     * Duplicate styles won't be registered more than once.
     *
     * @param Style $style The style to be registered
     * @return Style The registered style, updated with an internal ID.
     */
    public function registerStyle($style);

    /**
     * Apply additional styles if the given row needs it.
     * Typically, set "wrap text" if a cell contains a new line.
     *
     * @param Cell $cell
     * @return Style The updated style
     */
    public function applyExtraStylesIfNeeded(Cell $cell);
}