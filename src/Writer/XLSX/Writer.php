<?php

namespace Rocky114\Spreadsheet\Writer\XLSX;

class Writer
{
    protected $workbook;

    public function __construct()
    {
        $this->workbook = new Workbook();

        $this->workbook->setFilename(date("Y-m-d") . '.xlsx');
        $this->workbook->setTempFolder(sys_get_temp_dir());
    }

    public function setTempFolder($tempFolder)
    {
        $this->workbook->setTempFolder($tempFolder);

        return $this;
    }

    public function setFilename($filename)
    {
        $this->workbook->setFilename($filename);

        return $this;
    }

    public function addNewSheet($name)
    {
        $this->workbook->addNewSheet($name);

        return $this;
    }

    public function addHeader(array $header, array $formats = [])
    {
        $this->workbook->getCurrentSheet()->addHeader($header, $formats);

        return $this;
    }

    public function addRow(array $row = [])
    {
        $this->workbook->getCurrentSheet()->addRow($row);

        return $this;
    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function mergeCell($startCoordinate, $endCoordinate)
    {
        $this->workbook->getCurrentSheet()->mergeCell($startCoordinate, $endCoordinate);
    }

    /**
     * @return \Rocky114\Spreadsheet\Writer\XLSX\Workbook
     */
    public function getWorkbook()
    {
        return $this->workbook;
    }

    public function close()
    {
        $this->workbook->close();
    }

    public function save()
    {
        $this->close();
    }

    public function download()
    {
        $this->close();

        if (ob_get_length() > 0) {
            ob_end_clean();
        }

        $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        download($this->workbook->filename, $this->workbook->tempFolder . $this->workbook->filename, $contentType);
    }
}