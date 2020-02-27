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
            'size' => 12,
            'bold' => false,
        ]
    ];

    public function __construct()
    {
    }

    public function setSize(int $size)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $this->currentSheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['size'] = $size;
        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function setBold(bool $boolean)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $this->currentSheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['bold'] = $boolean;
        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function setName($name)
    {
        if (!isset($this->fontFormats[$this->currentCoordinate . $this->currentSheetId])) {
            $this->currentIndex++;
        }

        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['name'] = $name;
        $this->fontFormats[$this->currentCoordinate . $this->currentSheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function getFontFormats()
    {
        return $this->fontFormats;
    }

    public function getFontId(string $coordinate = null)
    {
        $key = $coordinate . $this->currentSheetId;
        if (isset($this->fontFormats[$key])) {
            return $this->fontFormats[$key]['id'];
        }

        return 0;
    }
}