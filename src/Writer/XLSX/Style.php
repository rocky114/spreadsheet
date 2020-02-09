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

    public function __construct($tempFolder)
    {
        $this->name = 'styles.xml';
        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->filePath = realpath(trim($tempFolder, '/')) . DIRECTORY_SEPARATOR . $this->name;
        $this->fileHandle = new FileHelper($this->filePath);
    }
}