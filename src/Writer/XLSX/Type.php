<?php

namespace Rocky114\Excel\Writer\XLSX;

class Type
{
    protected $sheetId;
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
        $this->setNumberFormat($formats);
    }

    public function getNumberFormat($name)
    {
        if (isset($this->numberFormats[$name.$this->sheetId])) {
            return $this->numberFormats[$name.$this->sheetId];
        }

        return [
            'code' => 'General',
            'id'   => 0
        ];
    }

    public function getNumberFormats()
    {
        if (empty($this->numberFormats)) {
            return [
                [
                    'code' => 'General',
                    'id'   => 0
                ]
            ];
        }

        return $this->numberFormats;
    }

    public function getCellValueType($name)
    {
        $format = $this->getNumberFormat($name);

        if (in_array($format['code'], ['0', '0.00', '#,##0', '#,##0.00'], true)) {
            return 'number';
        }

        return 'string';
    }

    public function setNumberFormat(array $formats, $sheetId = 1)
    {
        $this->sheetId = $sheetId;

        foreach ($formats as $key => $code) {
            if (isset($this->numberFormatCodeMap[$code])) {
                $code = $this->numberFormatCodeMap[$code];
            }

            if (isset($this->numberFormatCode[$code])) {
                $numberFormatId = $this->numberFormatCode[$code];

                $this->numberFormats[$key.$this->sheetId] = [
                    'code' => $code,
                    'id'   => $numberFormatId
                ];
            }
        }

        return $this;
    }
}