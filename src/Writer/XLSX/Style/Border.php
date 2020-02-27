<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Border
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $borderFormats = [
        'general' => [
            'id' => 0,
        ]
    ];

    public function __construct()
    {
    }

    public function getBorderFormats()
    {
        return $this->borderFormats;
    }

    public function getFontId(string $coordinate = null)
    {
        $key = $coordinate . $this->currentSheetId;
        if (isset($this->borderFormats[$key])) {
            return $this->borderFormats[$key]['id'];
        }

        return 0;
    }
}