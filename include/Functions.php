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
    }
}
else if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'devices':
            devices();
            break;
        case 'deviceinfo':
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['id'], $query);

            getDeviceInfo($query['id']);
            break;
        case 'scan':
            $state = $_POST['state'];

            toggleScan($state);
            break;
    }
}

function connect($deviceId)
{
    $response = "";

    exec("bluetoothctl pair $deviceId");
    exec("bluetoothctl trust $deviceId");
    exec("bluetoothctl connect $deviceId", $response);

    echo $response;
    exit;
}

function disconnect($deviceId)
{
    $response = "";
    
    exec("bluetoothctl untrust $deviceId");
    exec("bluetoothctl remove $deviceId", $response);
    
    echo $response;
    exit;
}

function getDeviceInfo($deviceId)
{
    $deviceInfo = "";

    exec("bluetoothctl info $deviceId", $deviceInfo);

    echo $deviceInfo;
    exit;
}

function devices()
{
    $devices = [];

    exec("bluetoothctl devices", $devices);

    echo json_encode($devices);
    exit;
}

function toggleScan($state)
{
    if ($state == true) {
        exec("bluetoothctl scan on");
        echo "Toggle Scan: On";
    } else {
        exec("bluetoothctl scan off");
        echo "Toggle Scan: Off";
    }

    exit;
}

?>