<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

trait Coordinate
{
    protected $currentCoordinate;
    protected $currentSheetId;

    /**
     * @param string $coordinate
     * @return $this
     */
    public function setCoordinate(string $coordinate)
    {
        $this->currentCoordinate = $coordinate;

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