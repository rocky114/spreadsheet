<?php

namespace Rocky114\Excel\Common;

use ZipArchive;
use Rocky114\Excel\Writer\XLSX\Workbook;

class ZipHelper
{
    protected $zipHandle;

    protected $zipFilePath;

    protected $workbook;

    public function __construct(Workbook $workbook)
    {
        $this->workbook = $workbook;
    }

    public function writeToZipArchive()
    {
        $this->zipHandle = new ZipArchive();
        $this->zipHandle->open($this->zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $this->zipHandle->addEmptyDir('docProps');
        $this->zipHandle->addFromString('docProps/app.xml', '');
        $this->zipHandle->addFromString('docProps/core.xml', '');

        $this->zipHandle->addEmptyDir('_rels/');
        $this->zipHandle->addFromString('_rels/.rels', '');

        $this->zipHandle->addEmptyDir('xl/worksheets/');
        foreach ($this->workbook->getWorksheets() as $worksheet) {
            $this->zipHandle->addFile($worksheet->filePath, 'xl/worksheets/' . $worksheet->sheetname);
        }

        $this->zipHandle->addFromString('xl/workbook.xml', '');
        $this->zipHandle->addFromString('[Content_Types].xml', '');
        $this->zipHandle->addEmptyDir('xl/_rels/');
        $this->zipHandle->addFromString('xl/_rels/workbook.xml.rels', '');

        $this->zipHandle->close();
    }

    public function getZipArchivePath()
    {
        return $this->zipFilePath;
    }
}