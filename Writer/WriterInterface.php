<?php

namespace Rocky114\Excel\Writer;

interface WriterInterface
{
    /**
     * @param $outputFilePath
     * @return mixed
     */
    public function openToFile($outputFilePath);

    /**
     * @param $outputFilePath
     * @return mixed
     */
    public function openToBrowser($outputFilePath);


    public function setDefaultRowStyle();


    public function addRow();


    public function addRows();


    public function close();
}