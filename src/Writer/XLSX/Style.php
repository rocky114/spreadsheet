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

    public function __construct(Workbook $workbook)
    {
        $this->name = 'styles.xml';
        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->fileHandle = new FileHelper($workbook->temp_folder . $this->name);
    }

    public function writeStylesXML()
    {

    }

    public function getStyleXML()
    {

    }
}