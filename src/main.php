<?php

$ipfile = $argv[1];
if (null == $ipfile || !file_exists($ipfile)) {
    echo 'ファイルを指定して下さい', PHP_EOL;
    exit(1);
}

require_once (__DIR__ . '/../vendor/autoload.php');
use GeoIp2\Database\Reader;

$getliteMmdb = __DIR__ . '/../GeoLite2-Country.mmdb';
$outputfile = __DIR__ . '/../count-country.txt';
$reader = new Reader($getliteMmdb);
$lines = file($ipfile);
$temp = array();
$process = 0;
$dateformat = "Y-m-d H:i:s ";

echo date($dateformat), 'rows:', count($lines), ' analyze country start', PHP_EOL;

foreach ($lines as $line) {
    $data = explode("\t", $line);
    $ip = $data[0];
    $record = $reader->country($ip);
    $isocode = $record->country->isoCode;
    $cnt = (count($data) >= 2) ? $data[1] : 1;
    $temp[$isocode] = (array_key_exists($isocode, $temp)) ? $temp[$isocode] + $cnt : $cnt;

    $process++;
    if ($process % 1000 == 0) {
        echo date($dateformat), $process, ' row', PHP_EOL;
    }
}

echo date($dateformat), 'analyze country end', PHP_EOL;

$result = array();
foreach ($temp as $isocode => $cnt) {
    $result[] = $isocode + "\t" + $cnt;
}

$reader->close();
file_put_contents($outputfile, $result);

echo date($dateformat), 'process end', PHP_EOL;

exit(0);
