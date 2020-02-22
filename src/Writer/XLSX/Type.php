<?php

namespace Rocky114\Excel\Writer\XLSX;

class Type
{
    protected $numberFormats = [];

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

    public function getNumberFormat($coordinate, int $sheetId)
    {
        if (isset($this->numberFormats[$coordinate . $sheetId])) {
            return $this->numberFormats[$coordinate . $sheetId];
        }

        $defaultFormat = [
            'general' => [
                'code' => 'General',
                'id'   => 0
            ]
        ];

        return $defaultFormat;
    }

    public function getNumberFormats()
    {
        $defaultFormat = [
            'general' => [
                'code' => 'General',
                'id'   => 0
            ]
        ];

        if (empty($this->numberFormats)) {
            return $defaultFormat;
        }

        return array_merge($defaultFormat, $this->numberFormats);
    }

    public function getCellValueType($coordinate, int $sheetId)
    {
        $format = $this->getNumberFormat($coordinate, $sheetId);

        if (in_array($format['code'], ['0', '0.00', '#,##0', '#,##0.00'], true)) {
            return 'number';
        }

        return 'string';
    }

    public function setNumberFormat(array $formats, int $sheetId)
    {
        foreach ($formats as $coordinate => $code) {
            if (isset($this->numberFormatCodeMap[$code])) {
                $code = $this->numberFormatCodeMap[$code];
            }

            if (!isset($this->numberFormatCode[$code])) {
                throw new \Exception('Invalid cell format');
            }

            $numberFormatId = $this->numberFormatCode[$code];

            $this->numberFormats[$coordinate . $sheetId] = [
                'code' => $code,
                'id'   => $numberFormatId
            ];
        }

        return $this;
    }
}