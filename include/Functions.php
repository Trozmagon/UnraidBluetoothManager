<?PHP
if (isset($_POST['method'])) {
    $deviceId = $_POST['id'];

    switch ($_POST['method']) {
        case 'connect':
            connect();
            break;
        case 'disconnect':
            disconnect();
            break;
    }
}

function connect()
{
    echo "The connect function is called.";
    exit;
}

function disconnect()
{
    echo "The disconnect function is called.";
    exit;
}
?>