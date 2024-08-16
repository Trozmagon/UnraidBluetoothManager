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

    exec("bluetoothctl pair $deviceId");
    exec("bluetoothctl trust $deviceId");
    exec("bluetoothctl connect $deviceId", $response);

    echo $response;
    exit;
}

function disconnect($deviceId)
{
    $response = [];
    
    exec("bluetoothctl untrust $deviceId");
    exec("bluetoothctl remove $deviceId", $response);
    
    echo $response;
    exit;
}

function devices()
{
    $devices = [];

    exec('bluetoothctl devices | cut -f2 -d" " | while read uuid; do bluetoothctl info $uuid; done | grep -e "Device\|Connected\|Name\|Paired"', $devices);
    
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