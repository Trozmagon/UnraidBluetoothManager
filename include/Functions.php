<?PHP
if (isset($_POST['method'])) {
    $deviceId = $_POST['id'];

    switch ($_POST['method']) {
        case 'connect':
            connect($deviceId);
            break;
        case 'disconnect':
            disconnect($deviceId);
            break;
        case 'devices':
            getDevices();
            break;
    }
}

function connect($deviceId)
{
    $response = [];

    exec("bluetoothctl connect $deviceId", $response);
    exec("bluetoothctl trust $deviceId");

    return $response;
}

function disconnect($deviceId)
{
    $response = [];

    exec("bluetoothctl untrust $deviceId");
    exec("bluetoothctl remove $deviceId", $response);
    
    return $response;
}

function getDevices()
{
    $devices = [];

    exec("bluetoothctl devices", $devices);

    return $devices;
}
?>