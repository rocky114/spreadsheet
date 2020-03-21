<?php

namespace Rocky114\Spreadsheet;

class FileFactory
{
    protected $buffer;

    protected $maxNumber = 10;

    protected $currentNumber = 0;

    protected $fileHandle;

    protected $filepath;

    /**
     * FileFactory constructor.
     * @param null $filepath
     * @param string $mode
     * @throws \Exception
     */
    public function __construct($filepath = null, $mode = 'w')
    {
        $this->filepath = $filepath;

        if (false === $this->fileHandle = fopen($filepath, $mode)) {
            throw new \Exception('Cannot open file ' . $filepath);
        }
    }

    /**
     * @param string $content
     * @throws \Exception
     */
    public function write(&$content = '')
    {
        $this->buffer .= $content;

        $this->currentNumber++;

        if ($this->currentNumber === 10) {
            $this->clearBuffer();
        }
    }

    public function getCsv()
    {
        return fgetcsv($this->fileHandle);
    }

    /**
     * @throws \Exception
     */
    public function clearBuffer()
    {
        if (false === fwrite($this->fileHandle, $this->buffer)) {
            throw new \Exception('Cannot write content.');
        }

        $this->buffer = '';
        $this->currentNumber = 0;
    }

    /**
     * @throws \Exception
     */
    public function close()
    {
        if ($this->currentNumber > 0) {
            $this->clearBuffer();
        }

        fclose($this->fileHandle);
    }

    /**
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }
}