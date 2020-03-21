<?php

namespace Rocky114\Spreadsheet\Reader;

abstract class ReaderAbstract
{
    protected $filepath;

    /**
     * @param string $filepath
     * @throws \Exception
     */
    public function open(string $filepath)
    {
        $this->filepath = realpath($filepath);
        if (!file_exists($this->filepath)) {
            throw new \Exception("Could not open {$this->filepath} for reading! File does not exist.");
        }

        if (!is_readable($this->filepath)) {
            throw new \Exception("Could not open {$this->filepath} for reading! File is not readable.");
        }
    }

    abstract public function getSheetIterator();

    abstract public function getSheet(int $index = 0);
}