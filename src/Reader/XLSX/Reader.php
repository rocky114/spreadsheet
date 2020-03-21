<?php

namespace Rocky114\Spreadsheet\Reader\XLSX;

use Rocky114\Spreadsheet\Reader\ReaderAbstract;

/**
 * Class Reader
 * @property \Rocky114\Spreadsheet\Reader\XLSX\Sheet $sheetHandle
 * @property  \Rocky114\Spreadsheet\Reader\XLSX\XMLReader $readerHandle
 */
class Reader extends ReaderAbstract
{
    protected $readerHandle;
    protected $sheetHandle;

    /**
     * @param $filepath
     * @throws \Exception
     */
    public function open(string $filepath)
    {
        parent::open($filepath);

        $this->readerHandle = new XMLReader($this->filepath);

        $this->readerHandle->readContentTypeXML();
        $this->readerHandle->readShareStringXML();

        $this->sheetHandle = new Sheet($this->readerHandle);
    }

    /**
     * @return \Rocky114\Spreadsheet\Reader\XLSX\Sheet
     */
    public function getSheetIterator()
    {
        return $this->sheetHandle;
    }

    /**
     * @param int $index
     * @return Sheet
     * @throws \Exception
     */
    public function getSheet(int $index = 0)
    {
        return $this->sheetHandle->setIndex($index);
    }
}