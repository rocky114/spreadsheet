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
        'General' => 0,
        '0' => 1,
        '0.00' => 2,
        '#,##0' => 3,
        '#,##0.00' => 4,
        '$#,##0,\-$#,##0' => 5,
        '$#,##0,[Red]\-$#,##0' => 6,
        '$#,##0.00,\-$#,##0.00' => 7,
        '$#,##0.00,[Red]\-$#,##0.00' => 8,
        '0%' => 9,
        '0.00%' => 10,
        '0.00E+00' => 11,
        '# ?/?' => 12,
        '# ??/??' => 13,
        'mm-dd-yy' => 14,
        'd-mmm-yy' => 15,
        'd-mmm' => 16,
        'mmm-yy' => 17,
        'h:mm AM/PM' => 18,
        'h:mm:ss AM/PM' => 19,
        'h:mm' => 20,
        'h:mm:ss' => 21,
        'm/d/yy h:mm' => 22,

        '#,##0 ,(#,##0)' => 37,
        '#,##0 ,[Red](#,##0)' => 38,
        '#,##0.00,(#,##0.00)' => 39,
        '#,##0.00,[Red](#,##0.00)' => 40,

        '_("$"* #,##0.00_),_("$"* \(#,##0.00\),_("$"* "-"??_),_(@_)' => 44,
        'mm:ss' => 45,
        '[h]:mm:ss' => 46,
        'mm:ss.0' => 47,

        '##0.0E+0' => 48,
        '@' => 49,

        '[$-404]e/m/d' => 27,
        'm/d/yy' => 30,
        't0' => 59,
        't0.00' => 60,
        't#,##0' => 61,
        't#,##0.00' => 62,
        't0%' => 67,
        't0.00%' => 68,
        't# ?/?' => 69,
        't# ??/??' => 70,
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

    /**
     * @param string $format
     * @return $this
     * @throws \Exception
     */
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