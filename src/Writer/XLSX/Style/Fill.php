<?php

namespace Rocky114\Excel\Writer\XLSX\Style;

class Fill
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $fillFormats = [
        'general' => [
            'id'           => 0,
            'pattern_type' => 'none',
        ]
    ];

    public function __construct()
    {
    }

    public function setPatternType(int $type)
    {
        if (!isset($this->fillFormats[$this->currentCoordinate . $this->currentSheetId])) {
            $this->currentIndex++;
        }

        $this->fillFormats[$this->currentCoordinate . $this->currentSheetId]['pattern_type'] = $type;
        $this->fillFormats[$this->currentCoordinate . $this->currentSheetId]['id'] = $this->currentIndex;

        return $this;
    }

    public function setForegroundColor(string $rgb)
    {
        $this->fillFormats[$this->currentCoordinate . $this->currentSheetId]['fg_color'] = $rgb;

        return $this;
    }

    public function setBackgroundColor(string $rgb)
    {
        $this->fillFormats[$this->currentCoordinate . $this->currentSheetId]['bg_color'] = $rgb;

        return $this;
    }

    public function getFontFormats()
    {
        return $this->fillFormats;
    }

    public function getFillId(string $coordinate = null)
    {
        $key = $coordinate . $this->currentSheetId;
        if (isset($this->fillFormats[$key])) {
            return $this->fillFormats[$key]['id'];
        }

        return 0;
    }
}