<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

class Border
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $borderFormats = [
        'general' => [
            'id'       => 0,
            'start'    => [],
            'end'      => [],
            'top'      => [],
            'bottom'   => [],
            'diagonal' => []
        ]
    ];

    public function __construct()
    {
    }

    public function getBorderFormats()
    {
        return $this->borderFormats;
    }

    public function getBorderId(string $coordinate = 'general')
    {
        if (isset($this->borderFormats[$coordinate])) {
            return $this->borderFormats[$coordinate]['id'];
        }

        return 0;
    }
}