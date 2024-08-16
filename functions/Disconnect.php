<?PHP
$deviceId = $_SERVER['id'];
$result = "";

exec("untrust $deviceId");
exec("remove $deviceId", $result);

echo implode(' ', $result);
?>