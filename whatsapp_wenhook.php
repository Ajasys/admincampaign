<?php



error_reporting(-1);
$verifyToken = 'ABC123545454412';
$access_token = 'your_page_access_token';

function writeToFile($data)
{
    $filename = 'whatsappwebhook_process_info.txt';
    $currentDateTime = date('Y-m-d H:i:s');
    $content = $currentDateTime . ': ' . $data . PHP_EOL;
    // $content = $currentDateTime . ': ' . json_encode($data) . PHP_EOL; // Encode the data before writing
    file_put_contents($filename, $content, FILE_APPEND);
}

writeToFile('check file');
$servername = "rudrram.com";
$username = "rudrramc_master_table";
$password = "-js}U)VQFr.T";
$databasename = "rudrramc_master_table";
// Create connection
$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $databasename
);
$check='not connected..';
if($conn)
{
    $check="connection successfully..";
}

writeToFile($check);
$input = file_get_contents('php://input');
$data = json_decode($input, true);
?>