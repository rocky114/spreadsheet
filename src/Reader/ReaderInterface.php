<?php

namespace Rocky114\Excel\Reader;

interface ReaderInterface
{
    public function open($filePath);

    public function getSheetIterator();

    public function close();
}