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

    protected $availableFormatCode = [
        'General',
        '0',
        '0.00',
        '#,##0',
        '#,##0.00',
        '@',
        'yyyy-mm-dd',
        'yyyy-mm-dd hh:mm:ss',
        'hh:mm AM/PM',
        'hh:mm:ss AM/PM',
        'hh:mm',
        'hh:mm:ss',
    ];

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

    public function getFormatCode($code)
    {
        $formatCodeMap = [
            'string'  => '@',
            'integer' => '0',
            'price'   => '#,##0.00',
            'date'    => 'yyyy-mm-dd'
        ];

        if (isset($formatCodeMap[$code])) {
            return $formatCodeMap[$code];
        }

        if (in_array($code, $this->availableFormatCode)) {
            return $code;
        }

        return 'General';
    }
}