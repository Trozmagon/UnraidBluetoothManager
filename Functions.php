<?PHP
if (isset($_POST['method'])) {
    switch ($_POST['method']) {
        case 'pair':
            pair($_POST['id']);
            break;
        case 'connect':
            connect($_POST['id']);
            break;
        case 'disconnect':
            disconnect($_POST['id']);
            break;
        case 'forget':
            forget($_POST['id']);
            break;
        case 'deviceinfo':
            getDeviceInfo($_POST['id']);
            break;
    }
}

if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'devices':
            devices();
            break;
        case 'startscan':
            startScan();
            break;
        case 'stopscan':
            stopScan();
            break;
    }
}

function pair($deviceId)
{
    exec("bluetoothctl pair $deviceId");
    exec("bluetoothctl trust $deviceId", $response);

    echo json_encode($response);
    exit;
}

function connect($deviceId)
{
    exec("bluetoothctl connect $deviceId", $response);

    echo json_encode($response);
    exit;
}

function disconnect($deviceId)
{
    exec("bluetoothctl disconnect $deviceId", $response);

    echo json_encode($response);
    exit;
}

function forget($deviceId)
{
    exec("bluetoothctl unpair $deviceId");
    exec("bluetoothctl untrust $deviceId");
    exec("bluetoothctl remove $deviceId", $response);

    echo json_encode($response);
    exit;
}

function getDeviceInfo($deviceId)
{
    exec("bluetoothctl info $deviceId", $deviceInfo);

    echo json_encode($deviceInfo);
    exit;
}

function devices()
{
    exec("bluetoothctl devices", $devices);

    echo json_encode($devices);
    exit;
}

function startScan()
{
    exec("bluetoothctl scan on" . " > /dev/null &");

    echo "Toggle Scan: On";
    exit;
}

function stopScan()
{
    exec("bluetoothctl scan off" . " > /dev/null &");

    echo "Toggle Scan: Off";
    exit;
}

?>