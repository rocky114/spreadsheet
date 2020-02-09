<?php

namespace Rocky114\Excel\Writer\XLSX;

class Row
{
    protected $type;

    protected $rowXML = '';

    protected $columnHeader = [];

    protected $currentRowIndex;

    public function __construct(Type $type = null)
    {

    }

    public function setCells($rowIndex, $cells)
    {
        $this->currentRowIndex = $rowIndex;

        $this->rowXML = '<row r="'.$this->currentRowIndex.'">';

        foreach ($cells as $index => $cell) {
            $this->rowXML .= $this->getCellXML($index, $cell);
        }

        $this->rowXML .= '</row>';

        return $this;
    }

    public function getRowXML()
    {
        return $this->rowXML;
    }

    protected function getCellXML($columnIndex, $cellValue)
    {
        $cellXML = '<c r="'.$this->getColumnHeader($columnIndex).$this->currentRowIndex.'" t="inlineStr">';
        $cellXML .= "<v>$cellValue</v></c>";

        return $cellXML;
    }

    public function getColumnHeader($index)
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