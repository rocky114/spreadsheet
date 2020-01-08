<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Writer\WriterInterface;

class Writer implements WriterInterface
{
    protected $outputFilePath;

    protected $filePointer;

    protected $isWriterOpen = false;

    public function openToFile($outputFilePath)
    {

    }


    public function openToBrowser($outputFilePath)
    {

    }


    public function setDefaultRowStyle()
    {

    }


    public function addRow()
    {

    }


    public function addRows()
    {

    }


    public function close()
    {

    }
}