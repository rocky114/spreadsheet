<?php

namespace Rocky114\Excel\Common\Helper;

class CellTypeHelper
{
    public static function isEmpty($value)
    {
        return $value === null || $value === '';
    }

    public static function isNonEmptyString($value)
    {
        return gettype($value) === 'string' && $value !== '';
    }

    public static function isNumeric($value)
    {
        $type = gettype($value);

        return $type === 'integer' || $type === 'double';
    }

    public static function isBoolean($value)
    {
        return is_bool($value);
    }

    public static function isDateTimeOrDateInterval($value)
    {
        return $value instanceof \DateTime || $value instanceof \DateInterval;
    }
}