<?php

use hotel\RoomReservations;


require_once '../src/DBconnect.php';
require_once "../src/functions/newRoomReservation.php";
session_start();

function correctSession()
{
    $_SESSION['temp_room_type'] = 'suite';
}

function sessionChanger()
{
    $_SESSION['temp_room_type'] = 'notARoom';
}

function formBuilder($testTitle, $roomArray, $formId, $connection)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit' . $formId])) {
            tempRoomReservation($connection, 1);
//            var_dump($_POST['submit'. $formId]);
        }
    }
    echo '<form method="post" action="" id="form' . $formId . '" name="form' . $formId . '">';
    $formArray = array(
        "employee_id", "customer_id", "date", "check_in", "check_out", "payment", "num_guests"
    );
    $combinedArray = array_combine($formArray, $roomArray);
    echo '<h1> ' . $testTitle . ' </h1> ';
    foreach ($combinedArray as $key => $value) {
        if ($key != "payment") {
            echo '<label for="' . $key . '">' . $key . '</label> <br>';
            if ($key == "employee_id" || $key == "customer_id") {
                echo '<input type="text" name="';
            } else if ($key == "date" || $key == "check_in" || $key == "check_out") {
                echo '<input type="date" name="';
            } else if ($key == "num_guests") {
                echo '<input type="number" name="';
            }
            echo $key . '" id="' . $key . '" value=' . $value . '> <br>';
        } else {
            echo '<p1> payment </p1> <br> <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br> ';
        }
    }
    echo '<input type="submit" name="submit' . $formId . '" value="Submit" form="form' . $formId . '">';
    echo '</form>';
}

// Path 1: Good data
$goodRoomArray = array(
    'employee_id' => '01',
    'customer_id' => '01',
    'date' => '2024-07-01 00:00:00.00',
    'check_in' => '2024-01-01 00:00:00.00',
    'check_out' => '2024-01-02 00:00:00.00',
    'payment' => 'card',
    'num_guests' => '01'
);
correctSession();
formBuilder("Good Room Test. P1", $goodRoomArray, 1, $connection);

// Path 2: Unavailable date
$badArray = $goodRoomArray;
formBuilder("Unavailable Date Test. P2", $badArray, 2, $connection);

// Path 3: Room id invalid
sessionChanger();
$badArray = $goodRoomArray;
$badArray['check_in'] = '2024-02-03 00:00:00.00';
$badArray['check_out'] = '2024-02-04 00:00:00.00';
formBuilder("Bad room_id Test. P3", $badArray, 3, $connection);

// Path 4:
correctSession();
$badArray = $goodRoomArray;
$badArray['check_in'] = '2024-03-05 00:00:00.00';
$badArray['check_out'] = '2024-03-06 00:00:00.00';
$badArray['employee_id'] = 0;
formBuilder("Bad employee_id Test. P4", $badArray, 4, $connection);

// Path 5:
$badArray = $goodRoomArray;
$badArray['check_in'] = '2024-04-07 00:00:00.00';
$badArray['check_out'] = '2024-04-08 00:00:00.00';
$badArray['num_guests'] = 0;
formBuilder("0 num_guests Test. P5", $badArray, 5, $connection);

// Path 6:
$badArray = $goodRoomArray;
$badArray['check_in'] = '';
$badArray['check_out'] = '';
formBuilder("check_in check_out Test. P6", $badArray, 6, $connection);

// Path 7:
$badArray = $goodRoomArray;
$badArray['date'] = "";
formBuilder("Bad host date Test. P7", $badArray, 7, $connection);

