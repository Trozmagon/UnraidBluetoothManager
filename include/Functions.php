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
    }
}

function connect($deviceId)
{
    echo "$deviceId";
    exit;
}

function disconnect($deviceId)
{
    echo "$deviceId";
    exit;
}
?>