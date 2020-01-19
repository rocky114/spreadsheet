<?php

namespace Rocky114\Excel\Writer\XLSX;

class Workbook
{
    protected $worksheets;

    public function __construct()
    {
    }

    public function getAppXml()
    {
        $html = <<<EOD
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties">
    <Application>rocky</Application>
    <TotalTime>0</TotalTime>
</Properties>
EOD;

        return $html;
    }

    public function getCoreXml()
    {
        $datetime = date("Y-m-d\TH:i:s");

        $html = <<<EOD
        <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <dcterms:created xsi:type="dcterms:W3CDTF">$datetime</dcterms:created>
    <dcterms:modified xsi:type="dcterms:W3CDTF">$datetime</dcterms:modified>
    <cp:revision>0</cp:revision>
</cp:coreProperties>
EOD;
        return $html;
    }

    public function getWorkbookXml()
    {

    }

    public function getContentTypeXml()
    {
        $html = <<<'EOD'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
    <Default ContentType="application/xml" Extension="xml"/>
    <Default ContentType="application/vnd.openxmlformats-package.relationships+xml" Extension="rels"/>
    <Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" PartName="/xl/workbook.xml"/>
EOD;

        foreach ($this->worksheets as $worksheet) {
            $html .= '<Override ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" PartName="/xl/worksheets/' . $worksheet->sheetname . '.xml"/>';
        }

        $html .= <<<'EOD'
    <Override ContentType="application/vnd.openxmlformats-package.core-properties+xml" PartName="/docProps/core.xml"/>
    <Override ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml" PartName="/docProps/app.xml"/>
</Types>
EOD;

        return $html;
    }
}