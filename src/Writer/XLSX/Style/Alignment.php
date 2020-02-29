<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Alignment
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $alignmentFormats = [
        'general' => [
            'id'         => 0,
            'wrap_text'  => false,
            'vertical'   => 'center',
            'horizontal' => 'general'
        ]
    ];

    public function __construct()
    {
    }

    public function setWrapText(bool $bool)
    {
        if (!isset($this->alignmentFormats[$this->currentCoordinate . $this->currentSheetId])) {
            $this->currentIndex++;
        }


        $this->alignmentFormats[$this->currentCoordinate . $this->currentSheetId] = [
            'id'         => $this->currentIndex,
            'wrap_text'  => $bool,
            'vertical'   => 'center',
            'horizontal' => 'general'
        ];

        return $this;
    }

    public function getFillFormats()
    {
        return $this->alignmentFormats;
    }

}