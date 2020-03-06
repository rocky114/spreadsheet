<?php

namespace Rocky114\Spreadsheet\Reader;

interface ReaderInterface
{
    public function open($filePath);

    public function getSheetIterator();

    public function close();
}