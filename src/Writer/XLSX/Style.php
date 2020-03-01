<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Writer\XLSX\Style\Alignment;
use Rocky114\Excel\Writer\XLSX\Style\Border;
use Rocky114\Excel\Writer\XLSX\Style\Fill;
use Rocky114\Excel\Writer\XLSX\Style\Font;

class Style
{
    protected $currentId;

    protected $typeHandle;
    protected $fontHandle;
    protected $fillHandle;
    protected $borderHandle;
    protected $alignmentHandle;

    protected $filename;

    protected $coordinates = [];

    protected $currentCoordinate;
    protected $currentSheetId;

    public function __construct()
    {
        $this->typeHandle = new Type();
        $this->fontHandle = new Font();
        $this->fillHandle = new Fill();
        $this->borderHandle = new Border();
        $this->alignmentHandle = new Alignment();
    }

    /**
     * @param string $coordinate
     * @param int $sheetId
     * @return $this
     */
    public function setCoordinate(string $coordinate, int $sheetId)
    {
        $this->coordinates[$coordinate . $sheetId] = [];

        $this->currentCoordinate = $coordinate;
        $this->typeHandle->setCoordinate($coordinate, $sheetId);
        $this->fontHandle->setCoordinate($coordinate, $sheetId);
        $this->fillHandle->setCoordinate($coordinate, $sheetId);
        $this->borderHandle->setCoordinate($coordinate, $sheetId);
        $this->alignmentHandle->setCoordinate($coordinate, $sheetId);

        return $this;
    }

    public function setSheetId(int $sheetId)
    {
        $this->currentSheetId = $sheetId;
        $this->typeHandle->setSheetId($sheetId);
        $this->fontHandle->setSheetId($sheetId);
        $this->fillHandle->setSheetId($sheetId);
        $this->borderHandle->setSheetId($sheetId);
        $this->alignmentHandle->setSheetId($sheetId);

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

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Style\Fill
     */
    public function getFill()
    {
        return $this->fillHandle;
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Style\Border
     */
    public function getBorder()
    {
        return $this->borderHandle;
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Style\Alignment
     */
    public function getAlignment()
    {
        return $this->alignmentHandle;
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
        $fontXML = '<fonts count="' . count($this->fontHandle->getFontFormats()) . '">';

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
        $fillXML = '<fills count="' . count($this->fillHandle->getFillFormats()) . '">';

        foreach ($this->fillHandle->getFillFormats() as $format) {
            $fillXML .= '<fill>';
            if ($format['pattern_type'] === 'none') {
                $fillXML .= '<patternFill patternType="none"/>';
            } else {
                $fillXML .= '<patternFill patternType="' . $format['pattern_type'] . '">';

                !empty($format['fg_color']) && $fillXML .= '<fgColor rgb="' . $format['fg_color'] . '"/>';
                !empty($format['bg_color']) && $fillXML .= '<bgColor rgb="' . $format['bg_color'] . '"/>';

                $fillXML .= '</patternFill>';
            }
            $fillXML .= '</fill>';
        }

        $fillXML .= '</fills>';

        return $fillXML;
    }

    public function createBorderXML()
    {
        $borderXML = '<borders count="' . count($this->borderHandle->getBorderFormats()) . '">';
        foreach ($this->borderHandle->getBorderFormats() as $key => $format) {
            $borderXML .= '<border>';
            if (empty($format['begin'])) {
                $borderXML .= '<begin/>';
            } else {

            }

            if (empty($format['end'])) {
                $borderXML .= '<end/>';
            } else {

            }

            if (empty($format['top'])) {
                $borderXML .= '<top/>';
            } else {

            }

            if (empty($format['bottom'])) {
                $borderXML .= '<bottom/>';
            } else {

            }

            $borderXML .= '<diagonal/></border>';
        }

        $borderXML .= '</borders>';

        return $borderXML;
    }

    public function createCellStyleXML()
    {
        $cellStyleXML = <<<HTML
            <cellStyleXfs count="1">
                <xf numFmtId="0" fontId="0" fillId="0" borderId="0">
			        <alignment vertical="center"/>
		        </xf>
		    </cellStyleXfs>
HTML;

        return $cellStyleXML;
    }

    public function getStyleXML()
    {
        $html = $this->createNumberFormatXML();
        $html .= $this->createFontXML();
        $html .= $this->createFillXML();
        $html .= $this->createBorderXML();
        $html .= $this->createCellStyleXML();

        $html .= '<cellXfs count="' . count($this->coordinates) . '">';
        foreach ($this->coordinates as $coordinate) {
            $html .= '<xf applyAlignment="false" applyBorder="false" applyFont="true" applyProtection="false" borderId="0" fillId="0" fontId="' . $coordinate['font_id'] . '" numFmtId="' . $coordinate['number_format_id'] . '" xfId="0">';
            $html .= '<alignment horizontal="general" vertical="center" wrapText="false"/>';
            $html .= '</xf>';
        }

        $html .= '</cellXfs>';

        return $html;
    }

    public function getStyleId($coordinate)
    {
        $key = $coordinate . $this->currentSheetId;
        if (isset($this->coordinates[$key])) {
            return $this->coordinates[$key]['id'];
        }

        $key = substr($coordinate, 0, 1) . $this->currentSheetId;
        if (isset($this->coordinates[$key])) {
            return $this->coordinates[$key]['id'];
        }

        return 0;
    }

    public function createColumnTypeStyle()
    {
        $numberFormats = $this->typeHandle->getNumberFormats();

        $id = count($this->coordinates);
        foreach ($numberFormats as $key => $format) {
            $this->coordinates[$key] = [
                'number_format_id' => $format['id'],
                'font_id'          => 0,
                'fill_id'          => 0,
                'border_id'        => 0,
                'id'               => $id,
            ];

            $id++;
        }

        return $this;
    }

    public function createCoordinateStyle()
    {
        $id = 0;
        foreach ($this->coordinates as $coordinate => $item) {
            $numberFormatId = $this->typeHandle->getNumberFormatId($coordinate);
            $fontId = $this->fontHandle->getFontId($coordinate);
            $fillId = $this->fillHandle->getFillId();
            $borderId = $this->borderHandle->getBorderId();

            $this->coordinates[$coordinate] = [
                'number_format_id' => $numberFormatId,
                'font_id'          => $fontId,
                'fill_id'          => $fillId,
                'border_id'        => $borderId,
                'id'               => $id,
            ];

            $id++;
        }

        return $this;
    }
}