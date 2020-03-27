<?php

namespace Rocky114\Spreadsheet\Writer\XLSX;

use Rocky114\Spreadsheet\Writer\XLSX\Style\Coordinate;

class Type
{
    use Coordinate;

    protected $numberFormats = [
        'general' => [
            'id'   => 0,
            'code' => 'General'
        ]
    ];

    protected $numberFormatCode = [
        'General'             => 0,
        '0'                   => 1,
        '0.00'                => 2,
        '#,##0'               => 3,
        '#,##0.00'            => 4,
        '@'                   => 5,
        'yyyy-mm-dd'          => 6,
        'yyyy-mm-dd hh:mm:ss' => 7,
        'hh:mm AM/PM'         => 8,
        'hh:mm:ss AM/PM'      => 9,
        'hh:mm'               => 10,
        'hh:mm:ss'            => 11,
    ];

    protected $numberFormatCodeMap = [
        'general' => 'General',
        'string'  => '@',
        'integer' => '0',
        'price'   => '#,##0.00',
        'date'    => 'yyyy-mm-dd'
    ];

    public function __construct(array $formats = [])
    {
    }

    public function getNumberFormatId($coordinate)
    {
        if (isset($this->numberFormats[$coordinate])) {
            return $this->numberFormats[$coordinate]['id'];
        }

        return 0;
    }

    public function getNumberFormats()
    {
        return $this->numberFormats;
    }

    public function getCellValueType($coordinate)
    {
        if (isset($this->numberFormats[$coordinate . '_' . $this->currentSheetId])) {
            $format = $this->numberFormats[$coordinate . '_' . $this->currentSheetId];

            if (in_array($format['code'], ['0', '0.00', '#,##0', '#,##0.00'], true)) {
                return 'number';
            }

            return 'string';
        }

        return null;
    }

    public function setNumberFormats(string $format)
    {
        if (isset($this->numberFormatCodeMap[$format])) {
            $format = $this->numberFormatCodeMap[$format];
        }

        if (!isset($this->numberFormatCode[$format])) {
            throw new \Exception('Invalid cell format');
        }

        $numberFormatId = $this->numberFormatCode[$format];

        $this->numberFormats[$this->currentCoordinate . '_' . $this->currentSheetId] = [
            'id'   => $numberFormatId,
            'code' => $format,
        ];

        return $this;
    }
}