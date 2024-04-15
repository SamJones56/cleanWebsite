<?php

use hotel\RoomReservations;

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

function goodRoomDataTest()
{
    global $connection;
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    require_once "../src/hotel/RoomReservations.php";
    require_once "../src/functions/newRoomReservation.php";

    // Declare room object
    $room1 = new RoomReservations();

    // Data for room object
    $room1array = array(
        'reservations_id' => '18',
        'employee_id' => '01',
        'customer_id' => '01',
        'date' => '2024-04-15 00:00:00.00',
        'check_in' => '2024-07-22 00:00:00.00',
        'check_out' => '2024-07-23 00:00:00.00',
        'total_price' => '100',
        'payment' => 'card',
        'num_guests' => '01',
        'checked_in' => '0'
    );
    // Check for valid roomid
    $room1array['room_id'] = checkRoomAvailabilityGivenRoom($connection, "suite", $room1array['check_in'], $room1array['check_out']);
    if($room1array['room_id']) {
        $room1->setFilledRoomRes($room1array);
        addToTable($connection, $room1->toReservationsArray(), "reservations");
        addToTable($connection, $room1->toRoomReservationsArray(), "roomreservations");
        echo "<br>";
        echo "Room added to table";
        echo "<br>";
    }
}

function badRoomDataTest()
{
    global $connection;
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    require_once "../src/hotel/RoomReservations.php";

    $room1 = new RoomReservations();

    $room1array = array(
        'reservations_id' => 'a',
        'employee_id' => 'b',
        'customer_id' => 'c',
        'date' => 'abc-abc-abc aa:bb:cc:dd',
        'check_in' => '2024-07-20 00:00:00.00',
        'check_out' => '2024-07-21 00:00:00.00',
        'total_price' => '100',
        'payment' => 'card',
        'num_guests' => '01',
        'checked_in' => '0'
    );
    $room1->setFilledRoomRes($room1array);
    addToTable($connection, $room1->toReservationsArray(),"reservations");
    addToTable($connection, $room1->toRoomReservationsArray(),"roomreservations");
}
echo "<h1>Good Room Data Test</h1>";
goodRoomDataTest();
echo "<br>";
echo "<h1>Bad Room Data Test</h1>";
badRoomDataTest();