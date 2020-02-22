<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Writer\XLSX\Style;

class Row
{
    protected $styleHandle;

    protected $rowXML = '';

    protected $columnHeader = [];

    protected $currentRowIndex;

    protected $sheetId;

    public function __construct(Style $style, int $sheetId)
    {
        $this->styleHandle = $style;
        $this->sheetId = $sheetId;
    }

    public function setCells($rowIndex, $cells)
    {
        $this->currentRowIndex = $rowIndex;

        $this->rowXML = '<row r="' . $this->currentRowIndex . '">';

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
        $coordinate = FunctionHelper::getColumnHeader($columnIndex);
        $styleId = $this->styleHandle->getStyleId($coordinate, $this->sheetId);

        $cellXML = '<c r="' . $coordinate . $this->currentRowIndex . '" s="'.$styleId.'"';

        if ($this->currentRowIndex === 1) {
            $type = 'string';
        } else if ($cellValue === null || $cellValue === '') {
            $type = 'null';
        } else {
            $type = $this->styleHandle->getType()->getCellValueType($columnIndex, $this->sheetId);
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