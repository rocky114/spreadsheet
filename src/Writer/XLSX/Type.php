<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Writer\XLSX\Style\Coordinate;

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
        $key = $coordinate . $this->currentSheetId;
        if (isset($this->numberFormats[$key])) {
            return $this->numberFormats[$key]['id'];
        }

        return 0;
    }

    public function getNumberFormats()
    {
        return $this->numberFormats;
    }

    public function getCellValueType($coordinate)
    {
        if (isset($this->numberFormats[$coordinate . $this->currentSheetId])) {
            $format = $this->numberFormats[$coordinate . $this->currentSheetId];

            if (in_array($format['code'], ['0', '0.00', '#,##0', '#,##0.00'], true)) {
                return 'number';
            }
        }

        return 'string';
    }

    public function setNumberFormats(array $formats)
    {
        foreach ($formats as $coordinate => $code) {
            if (isset($this->numberFormatCodeMap[$code])) {
                $code = $this->numberFormatCodeMap[$code];
            }

            if (!isset($this->numberFormatCode[$code])) {
                throw new \Exception('Invalid cell format');
            }

            $numberFormatId = $this->numberFormatCode[$code];

            $this->numberFormats[$coordinate . $this->currentSheetId] = [
                'code' => $code,
                'id'   => $numberFormatId
            ];
        }

        return $this;
    }
}