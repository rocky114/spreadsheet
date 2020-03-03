<?php

namespace Rocky114\Excel\Writer\CSV;

use Rocky114\Excel\Common\FunctionHelper;

class Writer
{
    protected $fileHandle;
    protected $filename;

    protected $options = [];

    public function __construct($config)
    {
        $this->options = [
            'temp_folder' => sys_get_temp_dir(),
            'filename'    => date("Y-m-d") . '.csv',
            'csv'         => [
                'delimiter'   => ',',
                'enclosure'   => '"',
                'escape_char' => '\\'
            ],
        ];

        $this->options = array_merge($this->options, $config);
        $this->options['temp_folder'] = realpath(rtrim($this->options['temp_folder'], '/')) . DIRECTORY_SEPARATOR;

        $this->filename = FunctionHelper::createUniqueId('.csv');
        if (false === $this->fileHandle = fopen($this->options['temp_folder'] . $this->filename, 'w')) {
            throw new \Exception('Cannot open file ' . $this->options['filename']);
        }
    }

    public function addHeader(array $header)
    {
        $this->addRow($header);

        return $this;
    }

    public function addRow(array $row = [])
    {
        $option = $this->options['csv'];

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

        header('Content-Type: ' . 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->options['filename'] . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        readfile($this->options['temp_folder'] . $this->filename);
    }
}