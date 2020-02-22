<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Writer\XLSX\Style\Font;

class Style
{
    protected $currentId;

    protected $typeHandle;
    protected $fontHandle;

    protected $filename;

    protected $coordinates = [];

    protected $currentCoordinate;

    public function __construct()
    {
        $this->typeHandle = new Type();
        $this->fontHandle = new Font();
    }

    public function setCurrentId($id)
    {
        $this->currentId = $id;
    }

    /**
     * @param $coordinate
     * @return $this
     */
    public function setCoordinate($coordinate)
    {
        $this->currentCoordinate = $coordinate;

        return $this;
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Type
     */
    public function getType()
    {
        return $this->typeHandle;
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Style\Font
     */
    public function getFont()
    {
        if (isset($this->coordinates[$this->currentCoordinate]['font'])) {
            return $this->coordinates[$this->currentCoordinate]['font'];
        }

        $fontHandle = new Font($this->currentCoordinate);
        $this->coordinates[$this->currentCoordinate]['font'] = $fontHandle;

        return $fontHandle;
    }

    public function createNumberFormatXML()
    {
        $formatXML = '<numFmts count="' . count($this->typeHandle->getNumberFormats()) . '">';

        foreach ($this->typeHandle->getNumberFormats() as $format) {
            $formatXML .= '<numFmt numFmtId="' . $format['id'] . '" formatCode="' . $format['code'] . '" />';
        }

        $formatXML .= '</numFmts>';

        return $formatXML;
    }

    public function createFontXML()
    {
        $fontXML = '<fonts count="' . count($this->coordinates) . '">';

        //$this->fontHandle->setBold();

        $fontXML .= '</fonts>';

        return $fontXML;
    }

    public function createFillXML()
    {
        return '';
    }

    public function createBorderXML()
    {
        return '';
    }

    public function getStyleXML()
    {
        $html = $this->createNumberFormatXML();
        $html .= $this->createFontXML();
        $html .= $this->createBorderXML();
        $html .= $this->createFillXML();

        return $html;
    }

    public function getStyleId($coordinate, $sheetId)
    {
        if (empty($this->coordinates)) {
            $numberFormats = $this->typeHandle->getNumberFormats();
            $fontId = $this->fontHandle->getFontId();

            $id = 0;
            foreach ($numberFormats as $key => $format) {
                $this->coordinates[$key] = [
                    'number_format_id' => $format['id'],
                    'font_id'          => $fontId,
                    'id'               => $id,
                ];

                $id++;
            }
        }

        $key = $coordinate . $sheetId;
        if (isset($this->coordinates[$key])) {
            return $this->coordinates[$key]['index'];
        }

        $key = substr($coordinate, 0, 1) . $sheetId;
        if (isset($this->coordinates[$key])) {
            return $this->coordinates[$key]['index'];
        }

        return 0;
    }
}