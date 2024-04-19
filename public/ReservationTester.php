<?php

use hotel\RoomReservations;

require_once '../src/DBconnect.php';
require_once "../src/functions/newRoomReservation.php";


function testSession()
{
    session_start();
    $_SESSION['temp_room_type'] = 'suite';
}
function roomBuilder($testTitle, $roomArray, $connection)
{

    $formArray = array(
        "employee_id", "customer_id", "date", "check_in", "check_out", "payment", "num_guests"
    );
    $combinedArray = array_combine($formArray, $roomArray);
    echo '<h1> ' . $testTitle . ' </h1> <form method="post">';
    foreach($combinedArray as $key => $value)
    {
        if($key != "payment") {
            echo '<label for="' . $key . '">' . $key . '</label> <br>';
            if ($key == "employee_id" || $key == "customer_id") {
                echo '<input type="text" name="';
            }
            else if ($key == "date" || $key == "check_in" || $key == "check_out") {
                echo '<input type="date" name="';
            }
            else if ($key == "num_guests"){
                echo '<input type="number" name="';
            }
            echo $key . '" id="' . $key . '" value=' . $value . '> <br>';
        }
        else
        {
            echo '<p1> payment </p1> <br> <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br> ';
        }
    }
    tempRoomReservation($connection, 1);
}

$goodRoomArray = array(
    'employee_id' => '01',
    'customer_id' => '01',
    'date' => '2024-04-15 00:00:00.00',
    'check_in' => '2024-07-22 00:00:00.00',
    'check_out' => '2024-07-23 00:00:00.00',
    'payment' => 'card',
    'num_guests' => '01',
);



testSession();
roomBuilder("Good Room Test",$goodRoomArray, $connection);
echo '<br> <input type="submit" name="submit" value="Submit"> </form>';