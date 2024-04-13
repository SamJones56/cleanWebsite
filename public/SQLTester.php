<?php
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "hotelTallafornia"; // database name
$dsn = "mysql:host=$host;dbname=$dbname"; // datbase DSN
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
global $connection;
$connection = new PDO($dsn, $username, $password, $options);
echo 'DB connected';

function goodConnect()
{
    global $connection;
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    echo 'DB connected';
    $inputArray = array(
            'Login_id' => '10',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'permissionlvl' => '3'

    );
    addToTable($connection,$inputArray,"login");
}
function badConnect()
{
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";

    $inputArray = array(
        'Login_id' => '04',
        'email' => 'admin@gmail.com',
        'password' => '123',
        'permissionlvl' => '3'
    );
    addToTable("notAPDO",$inputArray,"login");
}
function badData()
{
    global $connection;
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    $inputArray = array(
        'wrongData' => '07',
        'email' => 'admin@gmail.com',
        'password' => '123',
        'permissionlvl' => '3'

    );
    addToTable($connection,$inputArray,"login");
}
goodConnect();
//badConnect();
badData();


