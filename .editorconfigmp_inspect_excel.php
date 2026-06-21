<?php
$path = 'PERHITUNGAN MANUAL EXCEL SAYA.xlsx';
if (!file_exists($path)) {
    echo "missing file\n";
    exit(1);
}
$zip = new ZipArchive();
if ($zip->open($path) !== true) {
    echo "cannot open zip\n";
    exit(1);
}
$entries = [];
for ($i = 0; $i < $zip->numFiles; $i++) {
    $entries[] = $zip->getNameIndex($i);
}
foreach ($entries as $e) {
    echo $e . "\n";
}
$zip->close();
