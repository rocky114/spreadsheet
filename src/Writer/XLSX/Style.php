<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Writer\XLSX\Style\Color;

class Style
{
    const FONT_SIZE = 11;
    const FONT_COLOR = Color::BLACK;
    const FONT_NAME = 'Calibri';

    public $name;

    public $typeHandle;

    public function __construct(Workbook $workbook)
    {
        $this->name = 'styles.xml';
        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->fileHandle = new FileHelper($workbook->temp_folder . $this->name);

        $this->typeHandle = new Type();
    }

    public function writeStylesXML()
    {

    }

    public function getStyleXML()
    {

    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Type
     */
    public function getTypeHandle()
    {
        return $this->typeHandle;
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
}