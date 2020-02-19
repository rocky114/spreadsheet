<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Writer\XLSX\Style\Font;

class Style
{
    protected $typeHandle;
    protected $fontHandle;

    protected $filename;

    protected $coordinates = [];

    protected $currentCoordinate;

    public function __construct(Workbook $workbook)
    {
        $this->filename = FunctionHelper::createUniqueId('.xml');
        $this->fileHandle = new FileHelper($workbook->temp_folder . $this->filename);

        $this->typeHandle = new Type();
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
     * @return string
     */
    public function getStyleFilePath()
    {
        return $this->fileHandle->getFilePath();
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
        $fontXML = '<fonts count="4">';

        $this->fontHandle->setBold();

        $fontXML .= '</fonts>';

        return $fontXML;
    }

    public function createFillXML()
    {

    }

    public function createBorderXML()
    {

    }

    public function createStyleXML()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
HTML;

        $html .= <<<HTML
</styleSheet>
HTML;

        return $html;
    }
}