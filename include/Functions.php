<?PHP
if (isset($_POST['method'])) {
    switch ($_POST['method']) {
        case 'connect':
            $deviceId = $_POST['id'];

            connect($deviceId);
            break;
        case 'disconnect':
            $deviceId = $_POST['id'];

            disconnect($deviceId);
            break;
        case 'devices':
            devices();
            break;
        case 'scan':
            $state = $_POST['state'];

            toggleScan($state);
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

function devices()
{
    $devices = [];

    exec("bluetoothctl devices", $devices);

    return $devices;
}

function toggleScan($state)
{
    if ($state == true) {
        exec("bluetoothctl scan on");
    } else {
        exec("bluetoothctl scan off");
    }

    exit;
}

?>