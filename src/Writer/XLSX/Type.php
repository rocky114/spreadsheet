<?php

namespace Rocky114\Excel\Writer\XLSX;

class Type
{
    const TYPE_NUMERIC = 0;

    const TYPE_STRING = 1;

    const TYPE_FORMULA = 2;

    const TYPE_EMPTY = 3;

    const TYPE_BOOLEAN = 4;

    const TYPE_DATE = 5;

    protected $columns = [];

    public function __construct($types = [])
    {
        $this->setColumnType($types);
    }

    public function getColumnType($index)
    {
        return $this->columns[$index];
    }

    public function setColumnType($types)
    {
        foreach ($types as $key => $type) {
            switch ($type) {
                case 'string':
                    $type = '@';
                    break;
                case 'number':
                    $type = '0';
                    break;
                case 'price':
                    $type = '#,##0.00';
                    break;
                case 'date':
                    $type = 'YYYY-MM-DD';
                    break;
            }

            $this->columns[$key] = $type;
        }

        return $this;
    }
}