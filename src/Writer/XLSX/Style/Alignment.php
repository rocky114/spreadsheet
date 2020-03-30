<?php

namespace Rocky114\Spreadsheet\Writer\XLSX\Style;

class Alignment
{
    use Coordinate;

    protected $currentIndex = 0;

    protected $alignmentFormats = [];

    protected $horizontal = ['general', 'left', 'right', 'center', 'justify'];
    protected $vertical = ['bottom', 'center', 'top', 'justify'];

    public function __construct()
    {
        $this->alignmentFormats['general'] = [
            'id'         => 0,
            'wrap_text'  => 0,
            'vertical'   => 'center',
            'horizontal' => 'general'
        ];
    }

    public function initial($key)
    {
        if (!isset($this->alignmentFormats[$key])) {
            $this->currentIndex += 1;
            $this->alignmentFormats[$key] = [
                'id'         => $this->currentIndex,
                'wrap_text'  => 0,
                'vertical'   => 'center',
                'horizontal' => 'general'
            ];
        }
    }

    public function setWrapText(bool $bool)
    {
        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->alignmentFormats[$key]['wrap_text'] = $bool;

        return $this;
    }

    public function setHorizontal(string $horizontal)
    {
        !in_array($horizontal, $this->horizontal, true) && $horizontal = 'general';

        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->alignmentFormats[$key]['horizontal'] = $horizontal;

        return $this;
    }

    public function setVertical(string $vertical)
    {
        !in_array($vertical, $this->vertical, true) && $horizontal = 'center';

        $key = $this->currentCoordinate . '_' . $this->currentSheetId;
        $this->initial($key);

        $this->alignmentFormats[$key]['vertical'] = $vertical;

        return $this;
    }

    public function getAlignmentFormat(string $coordinate = 'general')
    {
        if (isset($this->alignmentFormats[$coordinate])) {
            return $this->alignmentFormats[$coordinate];
        }

        return $this->alignmentFormats['general'];
    }
}