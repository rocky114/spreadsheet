<?php

namespace Rocky114\Spreadsheet\Writer\CSV;

class Writer
{
    protected $fileHandle;
    protected $filename;
    protected $filePath;

    public $tempFolder;

    public $csvConfig = [
        'delimiter'   => ',',
        'enclosure'   => '"',
        'escape_char' => '\\'
    ];

    public function __construct()
    {
        $this->name = date("Y-m-d") . '.csv';
        $this->tempFolder = sys_get_temp_dir();
    }

    public function addNewSheet()
    {
        $this->filePath = $this->tempFolder.createUniqueId('.csv');
        if (false === $this->fileHandle = fopen($this->filePath, 'w')) {
            throw new \Exception('Cannot open file ' . $this->filename);
        }

        return $this;
    }

    public function setTempFolder($tempFolder)
    {
        $this->tempFolder = rtrim(realpath($tempFolder), '/') . DIRECTORY_SEPARATOR;

        return $this;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function setCsvConfig($option)
    {
        $this->csvConfig = $option;

        return $this;
    }

    public function addHeader(array $header)
    {
        $this->addRow($header);

        return $this;
    }

    public function addRow(array $row = [])
    {
        $option = $this->csvConfig;

        fputcsv($this->fileHandle, $row, $option['delimiter'], $option['enclosure'], $option['escape_char']);

        return $this;
    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function close()
    {
        fclose($this->fileHandle);
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

        download($this->filename, $this->filePath);
    }
}