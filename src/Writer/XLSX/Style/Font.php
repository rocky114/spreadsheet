<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Font
{
    protected $name = 'Calibri';
    protected $size = 11;
    protected $bold = false;

    protected $currentIndex = 0;

    protected $fontFormats = [
        [
            'name'  => 'Calibri',
            'size'  => 11,
            'bold'  => false,
            'index' => 0
        ]
    ];

    public function __construct()
    {
    }

    public function setSize(int $size, string $coordinate, int $sheetId)
    {
        if (!isset($this->fontFormats[$coordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$coordinate . $sheetId]['size'] = $size;
        $this->fontFormats[$coordinate . $sheetId]['index'] = $this->currentIndex;

        return $this;
    }

    public function setBold(bool $boolean, string $coordinate, int $sheetId)
    {
        if (!isset($this->fontFormats[$coordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$coordinate . $sheetId]['bold'] = $boolean;
        $this->fontFormats[$coordinate . $sheetId]['index'] = $this->currentIndex;

        return $this;
    }

    public function setName($name, string $coordinate, int $sheetId)
    {
        if (!isset($this->fontFormats[$coordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$coordinate . $sheetId]['name'] = $name;
        $this->fontFormats[$coordinate . $sheetId]['index'] = $this->currentIndex;

        return $this;
    }

    public function getFontFormats()
    {
        return $this->fontFormats;
    }

    public function getFontId(string $coordinate = null, int $sheetId = null)
    {
        $key = $coordinate . $sheetId;
        if (isset($this->fontFormats[$key])) {
            return $this->fontFormats[$key]['index'];
        }

        return 0;
    }
}