<?PHP
?>
<?
$scannedDevices = [];
exec("scan on", $scannedDevices);

echo implode(' ', $scannedDevices);
?>