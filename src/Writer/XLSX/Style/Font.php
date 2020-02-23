<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Font
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $fontFormats = [
        'general' => [
            'id'   => 0,
            'name' => 'Calibri',
            'size' => 11,
            'bold' => false,
        ]
    ];

    public function __construct()
    {
    }

    public function setSize(int $size, int $sheetId)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $sheetId]['size'] = $size;
        $this->fontFormats[$this->currentCoordinate . $sheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function setBold(bool $boolean, int $sheetId)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $sheetId]['bold'] = $boolean;
        $this->fontFormats[$this->currentCoordinate . $sheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function setName($name, int $sheetId)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $sheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $sheetId]['name'] = $name;
        $this->fontFormats[$this->currentCoordinate . $sheetId]['id'] = $this->currentIndex;

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
            return $this->fontFormats[$key]['id'];
        }

        return 0;
    }
}