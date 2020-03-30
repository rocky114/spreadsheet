<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

class Font
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $fontFormats = [];

    public function __construct()
    {
        $this->fontFormats['general'] = [
            'id'    => 0,
            'name'  => 'Calibri',
            'size'  => 12,
            'bold'  => 0,
            'color' => Color::BLACK
        ];
    }

    public function initial($key)
    {
        if (!isset($this->fontFormats[$key])) {
            $this->currentIndex += 1;
            $this->fontFormats[$key] = [
                'id'    => $this->currentIndex,
                'name'  => 'Calibri',
                'size'  => 12,
                'bold'  => 0,
                'color' => Color::BLACK
            ];
        }
    }

    public function setSize(int $size)
    {
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->fontFormats[$key]['size'] = $size;

        return $this;
    }

    public function setBold(bool $boolean)
    {
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->fontFormats[$key]['bold'] = (int)$boolean;

        return $this;
    }

    public function setName($name)
    {
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->fontFormats[$key]['name'] = $name;

        return $this;
    }

    public function setColor(string $rgb)
    {
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->fontFormats[$key]['color'] = $rgb;

        return $this;
    }

    public function getFontFormats()
    {
        return $this->fontFormats;
    }

    public function getFontId(string $coordinate = 'general')
    {
        if (isset($this->fontFormats[$coordinate])) {
            return $this->fontFormats[$coordinate]['id'];
        }

        return 0;
    }
}