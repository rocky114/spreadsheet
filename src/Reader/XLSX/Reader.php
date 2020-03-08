<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderInterface;
use \XMLReader;

class Reader implements ReaderInterface
{
    protected $sheets = [];
    protected $filePath;

    protected $hasShareStringFile = false;
    protected $shareStringHandle;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->shareStringHandle = new ShareString($filePath);
    }

    public function open()
    {
        $readerHandle = new XMLReader();
        if (false === $readerHandle->open("zip://{$this->filePath}#[Content_Types].xml")) {
            throw new \Exception('Could not open [Content_Types].xml for reading! File does not exist.');
        }

        while ($readerHandle->read()) {
            if ($readerHandle->nodeType === XMLReader::END_ELEMENT) {
                break;
            }

            $file = $readerHandle->getAttribute('PartName');
            if ($file === '/xl/sharedStrings.xml') {
                $this->hasShareStringFile = true;
                continue;
            }

            if (false !== strpos($file, '/xl/worksheets')) {
                $this->sheets[] = $file;
            }
        }

        $readerHandle->close();

        if ($this->hasShareStringFile) {
            $this->shareStringHandle->parseShareString();
        }
    }

    public function getSheetIterator()
    {

    }

    public function getSheetByIndex(int $index)
    {

    }

    public function getSheetByName(string $name)
    {

    }

    public function close()
    {

    }
}