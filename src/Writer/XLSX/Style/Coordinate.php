<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

trait Coordinate
{
    protected $currentCoordinate;
    protected $currentSheetId;

    /**
     * @param $coordinate
     * @return $this
     */
    public function setCoordinate(int $coordinate)
    {
        $this->currentCoordinate = $coordinate;

        return $this;
    }

    public function setSheetId(int $sheetId)
    {
        $this->currentSheetId = $sheetId;

        return $this;
    }
}