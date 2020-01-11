<?php

namespace Rocky114\Excel\Writer\Exception\Border;

use Rocky114\Excel\Common\Entity\Style\BorderPart;
use Rocky114\Excel\Writer\Exception\WriterException;

class InvalidStyleException extends WriterException
{
    public function __construct($name)
    {
        $msg = '%s is not a valid style identifier for a border. Valid identifiers are: %s.';

        parent::__construct(\sprintf($msg, $name, \implode(',', BorderPart::getAllowedStyles())));
    }
}
