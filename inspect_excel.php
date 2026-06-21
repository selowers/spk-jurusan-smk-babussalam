<?php
$path = __DIR__ . '/PERHITUNGAN MANUAL EXCEL SAYA.xlsx';
if (!file_exists($path)) {
    echo "Missing file: $path\n";
    exit(1);
}

$zip = new ZipArchive();
if ($zip->open($path) !== true) {
    echo "Could not open Excel file\n";
    exit(1);
}

$entries = [];
for ($i = 0; $i < $zip->numFiles; $i++) {
    $entries[] = $zip->getNameIndex($i);
}

sort($entries);
foreach ($entries as $entry) {
    echo "ENTRY: $entry\n";
}

$workbookXml = $zip->getFromName('xl/workbook.xml');
if ($workbookXml !== false) {
    echo "\n--- workbook.xml ---\n";
    echo $workbookXml;
}

$sharedXml = $zip->getFromName('xl/sharedStrings.xml');
if ($sharedXml !== false) {
    echo "\n--- sharedStrings.xml (first 2000 chars) ---\n";
    echo substr($sharedXml, 0, 2000);
}

$zip->close();
