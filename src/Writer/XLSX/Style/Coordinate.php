<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

trait Coordinate
{
    protected $currentCoordinate;
    protected $currentSheetId;

    /**
     * @param string $coordinate
     * @param int $sheetId
     * @return $this
     */
    public function setCoordinate(string $coordinate, int $sheetId)
    {
        $this->currentCoordinate = $coordinate;
        $this->currentSheetId = $sheetId;

        return $this;
    }

    /**
     * @param int $sheetId
     * @return $this
     */
    public function setSheetId(int $sheetId)
    {
        $this->currentSheetId = $sheetId;

        return $this;
    }
}