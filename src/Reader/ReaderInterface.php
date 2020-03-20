<?php

namespace Rocky114\Spreadsheet\Reader;

interface ReaderInterface
{
    public function open(string $path);
    public function close();
}