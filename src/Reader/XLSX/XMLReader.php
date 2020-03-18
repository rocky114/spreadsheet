<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

class XMLReader extends \XMLReader
{
    public $filePath;
    protected $hasShareStringFile = false;

    protected $sheets = [];
    protected $shareStrings = [];

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function readContentTypeXML()
    {
        if (false === $this->open("zip://{$this->filePath}#[Content_Types].xml")) {
            throw new \Exception('Could not open [Content_Types].xml for reading! File does not exist.');
        }

        while ($this->read()) {
            if ($this->nodeType === self::END_ELEMENT) {
                break;
            }

            $file = $this->getAttribute('PartName');

            if ($file === '/xl/sharedStrings.xml') {
                $this->hasShareStringFile = true;
                continue;
            }

            if (false !== strpos($file, '/xl/worksheets')) {
                $this->sheets[] = ltrim($file, '/');
            }
        }

        $this->close();
    }

    public function readShareStringXML()
    {
        if ($this->hasShareStringFile === false) {
            return null;
        }

        if (false === $this->open("zip://{$this->filePath}#xl/sharedStrings.xml")) {
            throw new \Exception('Could not open xl/sharedStrings.xml for reading! File does not exist.');
        }

        while ($this->read()) {
            if ($this->name === '#text') {
                $this->shareStrings[] = $this->value;
            }
        }

        $this->close();
    }

    public function getSheets()
    {
        return $this->sheets;
    }

    public function getShareStringByIndex(int $index)
    {
        return $this->shareStrings[$index];
    }
}