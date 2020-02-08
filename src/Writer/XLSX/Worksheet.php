<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;

class Worksheet
{
    public $id;

    public $name;

    public $filename;

    public $filePath;

    protected $fileHandle;

    protected $styleHandle;

    protected $typeHandle;

    public function __construct($id, $name, $config = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->filename = FunctionHelper::createUniqueId('.xml');

        $this->filePath = realpath(trim($config['temp_folder'], '/')) . DIRECTORY_SEPARATOR . $name;
        $this->fileHandle = new FileHelper($this->filePath);
    }

    public function addRow(array $row = [])
    {
        $content = '';

        $this->fileHandle->write($content);

        return $this;
    }

    public function addRows(array $rows = [])
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function getStyle()
    {
        $this->styleHandle = new Style\Style();

        return $this->styleHandle;
    }

    public function setColumnType($types = [])
    {
        $this->typeHandle = new Type($types);

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}