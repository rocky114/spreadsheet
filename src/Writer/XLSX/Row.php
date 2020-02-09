<?php

namespace Rocky114\Excel\Writer\XLSX;

class Row
{
    protected $type;

    protected $rowXML = '';

    protected $columnHeader = [];

    public function __construct(Type $type = null)
    {

    }

    public function setCells($rowIndex, $cells)
    {
        return $this;
    }

    public function getRowXML()
    {
        return $this->rowXML;
    }

    protected function getCellXML($rowIndex, $cellNumber, $cellValue)
    {
        $cellXML = '';

        return $cellXML;
    }

    public function getColumnIndexMap($index)
    {
        if (!isset($this->columnHeader[$index])) {
            $chars = '';
            $aAsciiNumber = ord('A');

            do {
                $chars = chr($index % 26 + $aAsciiNumber) . $chars;

                $index = intval($index / 26);
            } while ($index > 0);

            $this->columnHeader[$index] = $chars;
        }

        return $this->columnHeader[$index];
    }
}