<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderInterface;
use \XMLReader;

class Reader implements ReaderInterface
{
    protected $isShareString = false;
    protected $readerHandle;
    protected $sheets = [];
    protected $shareFile;
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->readerHandle = new \XMLReader();
    }

    public function open()
    {
        $this->parseContentType();
    }

    public function parseContentType()
    {
        if (false === $this->readerHandle->open("zip://{$this->filePath}#[Content_Types].xml")) {
            throw new \Exception('Could not open [Content_Types].xml for reading! File does not exist.');
        }

        while ($this->readerHandle->read()) {
            $file = $this->readerHandle->getAttribute('PartName');
            if ($file === '/xl/sharedStrings.xml') {
                $this->shareFile = '/xl/sharedStrings.xml';
                continue;
            }

            if (false !== strpos($file, '/xl/worksheets')) {
                $this->sheets[] = $file;
                continue;
            }

            if ($this->readerHandle->nodeType === XMLReader::END_ELEMENT) {
                break;
            }
        }

        $this->readerHandle->close();
    }

    public function parseShareString()
    {

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