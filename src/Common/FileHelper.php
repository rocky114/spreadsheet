<?php

namespace Rocky114\Excel\Common;

use SplFileObject;

class FileHelper extends SplFileObject
{
    protected $buffer;

    protected $maxNumber = 10;

    protected $currentNumber = 0;

    public function __construct($filename = null)
    {
        parent::__construct($filename, 'w');
    }

    public function setBuffer($content = '')
    {
        $this->buffer .= $content;

        $this->currentNumber++;

        if ($this->currentNumber === 10) {
            $this->fwrite($this->buffer);

            $this->clearBuffer();
        }
    }

    public function clearBuffer()
    {
        $this->buffer = '';
        $this->currentNumber = 0;
    }
}