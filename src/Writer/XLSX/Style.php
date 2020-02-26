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
    protected $currentSheetId;

    public function __construct()
    {
        $this->typeHandle = new Type();
        $this->fontHandle = new Font();
    }

    /**
     * @param $coordinate
     * @return $this
     */
    public function setCoordinate(string $coordinate)
    {
        $this->currentCoordinate = $coordinate;
        $this->typeHandle->setCoordinate($coordinate);
        $this->fontHandle->setCoordinate($coordinate);

        return $this;
    }

    public function setSheetId(int $sheetId)
    {
        $this->currentSheetId = $sheetId;
        $this->typeHandle->setSheetId($sheetId);
        $this->fontHandle->setSheetId($sheetId);

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
        return $this->fontHandle;
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

        foreach ($this->fontHandle->getFontFormats() as $format) {
            $fontXML .= <<<HTML
                <font>
                    <name val="{$format['name']}"/>
                    <sz val="{$format['size']}"/>
                </font>
HTML;
        }

        $fontXML .= '</fonts>';

        return $fontXML;
    }

    public function createFillXML()
    {
        $fillXML = <<<HTML
            <fills count="1">
                <fill>
                    <patternFill patternType="none"/>
                </fill>
            </fills>
HTML;

        return $fillXML;
    }

    public function createBorderXML()
    {
        $borderXML = <<<HTML
            <borders count="1">
                <border diagonalDown="false" diagonalUp="false">
                    <left/><right/><top/><bottom/><diagonal/>
                </border>
            </borders>
HTML;

        return $borderXML;
    }

    public function getStyleXML()
    {
        $html = $this->createNumberFormatXML();
        $html .= $this->createFontXML();
        $html .= $this->createFillXML();
        $html .= $this->createBorderXML();

        $html .= '<cellXfs count="'.count($this->coordinates).'">';
        foreach ($this->coordinates as $coordinate) {
            $html .= '<xf applyAlignment="false" applyBorder="false" applyFont="true" applyProtection="false" borderId="0" fillId="0" fontId="'.$coordinate['font_id'].'" numFmtId="'.$coordinate['number_format_id'].'" xfId="0">';
            $html .= '<alignment horizontal="general" vertical="bottom" textRotation="0" wrapText="false" indent="0" shrinkToFit="false"/>';
            $html .= '<protection locked="true" hidden="false"/>';
            $html .= '</xf>';
        }

        $html .= '</cellXfs>';

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