<?php

namespace Rocky114\Spreadsheet\Writer\XLSX;

class Writer
{
    protected $fileHandle;

    protected $zipHandle;
    protected $workbook;

    public function __construct()
    {
        $this->workbook = new Workbook();
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
        foreach ($this->workbook->getWorksheets() as $worksheet) {
            $worksheet->closeSheet();
        }

        $this->workbook->writeToZipArchive();

        foreach ($this->workbook->getWorksheets() as $worksheet) {
            unlink($worksheet->filePath);
        }
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

        header('Content-Type: ' . 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->workbook->filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        readfile($this->workbook->temp_folder . $this->workbook->filename);
    }
}