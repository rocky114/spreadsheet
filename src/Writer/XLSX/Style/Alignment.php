<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

class Alignment
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $alignmentFormats = [
        'general' => [
            'id'         => 0,
            'wrap_text'  => 0,
            'vertical'   => 'center',
            'horizontal' => 'general'
        ]
    ];

    public function __construct()
    {
    }

    public function setWrapText(bool $bool)
    {
        if (!isset($this->alignmentFormats[$this->currentCoordinate . '_' . $this->currentSheetId])) {
            $this->currentIndex++;
        }

        $this->alignmentFormats[$this->currentCoordinate . '_' . $this->currentSheetId] = [
            'id'         => $this->currentIndex,
            'wrap_text'  => $bool,
            'vertical'   => 'center',
            'horizontal' => 'general'
        ];

        return $this;
    }

    public function getAlignmentFormat(string $coordinate = 'general')
    {
        $key = $coordinate . '_' . $this->currentSheetId;
        if (isset($this->alignmentFormats[$key])) {
            return $this->alignmentFormats[$key];
        }

        return $this->alignmentFormats['general'];
    }

}