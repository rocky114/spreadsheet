<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

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
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        if (!isset($this->fillFormats[$key])) {
            $this->currentIndex++;
        }

        $this->fillFormats[$key]['pattern_type'] = $type;
        $this->fillFormats[$key]['id'] = $this->currentIndex;

        return $this;
    }

    public function setForegroundColor(string $rgb)
    {
        $this->fillFormats[$this->currentCoordinate . '_' . $this->currentSheetId]['fg_color'] = $rgb;

        return $this;
    }

    public function setBackgroundColor(string $rgb)
    {
        $this->fillFormats[$this->currentCoordinate . '_' . $this->currentSheetId]['bg_color'] = $rgb;

        return $this;
    }

    public function getFillFormats()
    {
        return $this->fillFormats;
    }

    public function getFillId(string $coordinate = null)
    {
        $key = $coordinate . '_' . $this->currentSheetId;
        if (isset($this->fillFormats[$key])) {
            return $this->fillFormats[$key]['id'];
        }

        return 0;
    }
}