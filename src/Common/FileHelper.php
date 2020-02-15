<?php

namespace Rocky114\Excel\Common;

class FileHelper
{
    protected $buffer;

    protected $maxNumber = 10;

    protected $currentNumber = 0;

    protected $fileHandle;

    protected $filePath;

    public function __construct($filePath = null, $mode = 'w')
    {
        $this->filePath = $filePath;

        if (false === $this->fileHandle = fopen($filePath, $mode)) {
            throw new \Exception('Cannot open file '.$filePath);
        }
    }

    public function write(&$content = '')
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

    public function close()
    {
        fclose($this->fileHandle);
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function __destruct()
    {
    }
}