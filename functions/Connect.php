<?PHP
$deviceId = $_SERVER['id'];
$result = "";

exec("connect $deviceId");
exec("trust $deviceId", $result);

echo implode(' ', $result);
?>