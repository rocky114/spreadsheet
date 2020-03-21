<?php

namespace Rocky114\Spreadsheet\Reader\CSV;

use Rocky114\Spreadsheet\FileFactory;
use Rocky114\Spreadsheet\Reader\ReaderAbstract;

class Reader extends ReaderAbstract
{
    protected $fileHandle;
    protected $sheetHandle;

    /**
     * @param string $filepath
     * @throws \Exception
     */
    public function open(string $filepath)
    {
        parent::open($filepath);

        $this->fileHandle = new FileFactory($this->fileHandle, "r");
        $this->sheetHandle = new Sheet($this->fileHandle);
    }

    public function getSheetIterator()
    {
        return $this->sheetHandle;
    }

    public function getSheet(int $index = 0)
    {
        return $this->sheetHandle;
    }
}