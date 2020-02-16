<?php

namespace Rocky114\Excel\Writer\XLSX;

class Row
{
    protected $typeHandle;

    protected $rowXML = '';

    protected $columnHeader = [];

    protected $currentRowIndex;

    public function __construct()
    {
    }

    public function setTypeHandle(Type $type)
    {
        $this->typeHandle = $type;
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

    protected function getCellXML($columnIndex, $cellValue = '')
    {
        $cellXML = '<c r="'.$this->getColumnHeader($columnIndex).$this->currentRowIndex.'"';

        $type = $this->typeHandle->getColumnType($columnIndex);
        switch ($type) {
            case 'string':
                $cellXML .= ' t="inlineStr"><is><t>'.$cellValue.'</t></is>';
                break;
            case 'number':
                $cellXML .= ' t="n"><v>'.$cellValue.'</v>';
                break;
            case 'boolean':
                $cellXML .= ' t="b"><v>'.$cellValue.'</v>';
                break;
            default:
                throw new \Exception($cellValue.' is unknown type');
        }

        $cellXML .= '</c>';

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