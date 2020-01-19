<?php

namespace Rocky114\Excel\Writer\Common;

class Type
{
    const TYPE_NUMERIC = 0;

    const TYPE_STRING = 1;

    const TYPE_FORMULA = 2;

    const TYPE_EMPTY = 3;

    const TYPE_BOOLEAN = 4;

    const TYPE_DATE = 5;

    protected $columnTypes = [];

    public function __construct($types = [])
    {
        $this->setColumnType($types);
    }

    public function getColumnType($index)
    {
        return $this->columnTypes[$index];
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

            $this->columnTypes[$key] = $type;
        }

        return $this;
    }
}