<?php

namespace Rocky114\Excel\Common;

class FileHelper
{
    protected $buffer;

    protected $maxNumber = 10;

    protected $currentNumber = 0;

    protected $fileHandle;

    public function __construct($filename = null, $mode = 'w')
    {
        if (false === $this->fileHandle = fopen($filename, $mode)) {
            throw new \Exception('Cannot open file '.$filename);
        }
    }

    public function write($content = '')
    {
        $this->buffer .= $content;

        $this->currentNumber++;

        if ($this->currentNumber === 10) {
            $this->clearBuffer($this->buffer);
        }
    }

    public function clearBuffer(&$content)
    {
        if (false === fwrite($this->fileHandle, $content)) {
            throw new \Exception('Cannot write content.');
        }

        $this->buffer = '';
        $this->currentNumber = 0;
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }
}