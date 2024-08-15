<?PHP
?>
<?
$devices = [];
exec("bluetoothctl", $devices);
sort($devices);
echo implode(' ',$devices);
?>