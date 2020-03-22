<?php

namespace Rocky114\Spreadsheet\Writer\XLSX;

class Row
{
    protected $styleHandle;

    protected $rowXML = '';

    protected $columnHeader = [];

    protected $currentRowIndex;

    protected $sheetId;

    protected $isTableHeader = false;

    public function __construct(Style $style, int $sheetId)
    {
        $this->styleHandle = $style;
        $this->sheetId = $sheetId;
    }

    public function setCells($rowIndex, $cells)
    {
        $this->currentRowIndex = $rowIndex;

        $this->rowXML = '<row r="' . $this->currentRowIndex . '">';

        foreach ($cells as $columnIndex => $cell) {
            $this->rowXML .= $this->getCellXML($columnIndex, $cell);
        }

        $this->rowXML .= '</row>';

        return $this;
    }

    public function setTableHeader(bool $bool)
    {
        $this->isTableHeader = $bool;

        return $this;
    }

    public function getRowXML()
    {
        return $this->rowXML;
    }

    protected function getCellXML(int $columnIndex, string &$cellValue = '')
    {
        $coordinate = getSheetHeaderChar($columnIndex);
        $styleId = $this->styleHandle->getStyleId($coordinate);

        $cellXML = '<c r="' . $coordinate . $this->currentRowIndex . '" s="' . $styleId . '"';

        if ($this->isTableHeader) {
            $type = 'string';
        } else {
            $type = $this->styleHandle->getType()->getCellValueType($coordinate);

            if ($type === null) {
                if ($cellValue === null || $cellValue === '') {
                    $type = 'null';
                } else if (is_numeric($cellValue)) {
                    $type = 'number';
                } else {
                    $type = 'string';
                }
            }
        }

        switch ($type) {
            case 'string':
                $cellXML .= ' t="inlineStr"><is><t>' . $cellValue . '</t></is>';
                break;
            case 'number':
                $cellXML .= ' t="n"><v>' . $cellValue . '</v>';
                break;
            case 'boolean':
                $cellXML .= ' t="b"><v>' . $cellValue . '</v>';
                break;
            case 'null':
                $cellXML .= '/>';
                break;
            default:
                throw new \Exception($cellValue . ' is unknown type');
        }

        $cellXML .= '</c>';

        return $cellXML;
    }
}