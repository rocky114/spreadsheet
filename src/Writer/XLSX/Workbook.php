<?php

namespace Rocky114\Excel\Writer\XLSX;

class Workbook
{
    protected $worksheets;

    public function __construct()
    {
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

    }

    public function createContentTypeXml()
    {
        $worksheetHtml = '';
        foreach ($this->worksheets as $worksheet) {
            $worksheetHtml .= '<Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" PartName="/xl/worksheets/' . $worksheet->sheetname . '.xml"/>';
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
</Types>
HTML;

        return $html;
    }

    public function createRelXml()
    {
        $html = <<<HTML
<?xml version="1.0" encoding="UTF-8"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rIdWorkbook" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
    <Relationship Id="rIdCore" Type="http://schemas.openxmlformats.org/officedocument/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>
    <Relationship Id="rIdApp" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/>
</Relationships>
HTML;

        return $html;
    }

    public function getWorksheets()
    {
        return [];
    }
}