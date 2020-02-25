<?php

namespace Rocky114\Excel\Writer\XLSX;

use Rocky114\Excel\Common\FileHelper;
use Rocky114\Excel\Common\FunctionHelper;

class Workbook
{
    protected $worksheets = [];

    protected $currentSheet;

    protected $workbookId;

    protected $styleHandle;

    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;

        $this->workbookId = FunctionHelper::createUniqueId('.xlsx');

        $this->styleHandle = new Style();
    }

    public function getWorkbookId()
    {
        return $this->workbookId;
    }

    public function addNewSheet($name)
    {
        if (isset($this->worksheets[$name])) {
            throw new \Exception("$name already exists");
        }

        if ($this->isInvalidSheetName($name)) {
            throw new \Exception("sheet name should not contain these characters: \\ / ? * : [ or ]");
        }

        $sheetId = count($this->worksheets) + 1;
        $this->worksheets[$name] = $this->currentSheet = new Worksheet($sheetId, $name, $this);

        return $this;
    }

    public function isInvalidSheetName($name)
    {
        $invalidChars = ['\\', '/', '?', '*', ':', '[', ']'];

        return (str_replace($invalidChars, '', $name) !== $name);
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Worksheet
     */
    public function getCurrentSheet()
    {
        return $this->currentSheet;
    }

    public function setCurrentSheet($sheet)
    {
        $this->currentSheet = $sheet;
    }

    public function getWorksheetByName($name)
    {
        if (!isset($this->worksheets[$name])) {
            throw new \Exception("sheet $name not exists");
        }

        return $this->worksheets[$name];
    }

    public function createAppXml()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties">
    <Application>rocky</Application>
    <TotalTime>0</TotalTime>
</Properties>
HTML;

        return $html;
    }

    public function createCoreXml()
    {
        $datetime = date("Y-m-d\TH:i:s");

        $html = <<<STRING
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <dcterms:created xsi:type="dcterms:W3CDTF">$datetime</dcterms:created>
    <dcterms:modified xsi:type="dcterms:W3CDTF">$datetime</dcterms:modified>
    <cp:revision>0</cp:revision>
</cp:coreProperties>
STRING;
        return $html;
    }

    public function createWorkbookXml()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
    <sheets>
HTML;

        foreach ($this->worksheets as $index => $worksheet) {
            $html .= '<sheet name="' . $worksheet->name . '" sheetId="' . $worksheet->getId() . '" r:id="rIdSheet' . $worksheet->getId() . '"/>';
        }

        $html .= <<<HTML
    </sheets>
</workbook>
HTML;

        return $html;
    }

    public function createContentTypeXml()
    {
        $worksheetHtml = '';
        foreach ($this->worksheets as $worksheet) {
            $worksheetHtml .= '<Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" PartName="/xl/worksheets/' . $worksheet->name . '.xml"/>';
        }

        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
    <Default ContentType="application/xml" Extension="xml"/>
    <Default ContentType="application/vnd.openxmlformats-package.relationships+xml" Extension="rels"/>
    <Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" PartName="/xl/workbook.xml"/>
    $worksheetHtml
    <Override ContentType="application/vnd.openxmlformats-package.core-properties+xml" PartName="/docProps/core.xml"/>
    <Override ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml" PartName="/docProps/app.xml"/>
    <Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" PartName="/xl/styles.xml"/>
</Types>
HTML;

        return $html;
    }

    public function createRelXml()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
    <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officedocument/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>
    <Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/>
</Relationships>
HTML;

        return $html;
    }

    public function createWorkbookRelXml()
    {
        $worksheetHtml = '';
        foreach ($this->worksheets as $key => $worksheet) {
            $worksheetHtml .= '<Relationship Id="rId' . $key . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/' . $worksheet->name . '.xml"/>';
        }

        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="style" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
    $worksheetHtml
</Relationships>
HTML;

        return $html;
    }

    public function createStyleXml()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
HTML;
        $html .= $this->styleHandle->getStyleXML();
        $html .= <<<HTML
</styleSheet>
HTML;

        $filename = FunctionHelper::createUniqueId('.xml');

        $fileHandle = new FileHelper($this->temp_folder . $filename);
        $fileHandle->write($html);
        $fileHandle->close();

        return $fileHandle->getFilePath();
    }

    /**
     * @return array
     */
    public function getWorksheets()
    {
        return $this->worksheets;
    }

    /**
     * @return \Rocky114\Excel\Writer\XLSX\Style
     */
    public function getStyle()
    {
        return $this->styleHandle;
    }

    public function __get($name)
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }

        throw new \Exception('undefined index' . $name);
    }
}