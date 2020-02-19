<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;
use Rocky114\Excel\Writer\XLSX\Style\Color;
use Rocky114\Excel\Writer\XLSX\Style\Font;

class Style
{
    protected $typeHandle;
    protected $fontHandle;

    protected $filename;

    public function __construct(Workbook $workbook)
    {
        $this->filename = FunctionHelper::createUniqueId('.xml');
        $this->fileHandle = new FileHelper($workbook->temp_folder . $this->filename);

        $this->typeHandle = new Type();
        $this->fontHandle = new Font();
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
}