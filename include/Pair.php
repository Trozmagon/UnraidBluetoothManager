<?PHP
?>
<?
$deviceId = $_SERVER['id'];
exec("pair $deviceId", $result);

echo implode(' ', $result);
?>