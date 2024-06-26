<?php

dateTester();
function dateTester()
{
    require_once '../src/DBconnect.php';
    require_once "../src/functions/newRoomReservation.php";
    require_once "../src/functions/newRestaurantReservationsFunctions.php";
    session_start();
    $_SESSION['permissionlvl'] = 0;
    $_SESSION['temp_room_type'] = 'suite';
    $_SESSION['temp_cap'] = 4;

    // Good room date
    $goodRoomArray = array(
        'employee_id' => '01',
        'customer_id' => '01',
        'date' => '2024-07-01 00:00:00.00',
        'check_in' => '2024-10-01 00:00:00.00',
        'check_out' => '2024-11-02 00:00:00.00',
        'payment' => 'card',
        'num_guests' => '01'
    );
    // Room form
    $roomFormArray = array(
        "employee_id", "customer_id", "date", "check_in", "check_out", "payment", "num_guests"
    );
    // Good table date
    $goodTableArray = array(
        'employee_id' => '01',
        'customer_id' => '01',
        'date' => '2024-07-01 00:00:00.00',
        'time' => '12:00',
        'num_guests' => '01'
    );
    // Table form
    $tableFormArray = array(
        "employee_id", "customer_id", "date", "time", "num_guests"
    );
    // Build good room date
    dateFormBuilder("Good Room Date", $roomFormArray, $goodRoomArray, 1, $connection);
    // Build conflicting room date
    dateFormBuilder("Bad Room Date", $roomFormArray, $goodRoomArray, 2, $connection);
    // Build good table date
    dateFormBuilder("Good Table Date", $tableFormArray, $goodTableArray, 3, $connection);
    // Build conflicting table date
    dateFormBuilder("Bad Table Date", $tableFormArray, $goodTableArray, 4, $connection);
}

function dateFormBuilder($testTitle, $formArray, $formDataArray, $formId, $connection)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit' . $formId])) {
            if ((int)$formId == 1) {
                tempRoomReservation($connection, 1);
            }
            if ((int)$formId == 2) {
                tempRoomReservation($connection, 1);
            }
            if ((int)$formId == 3) {
                tempTableReservation($connection, 1);
            }
            if ((int)$formId == 4) {
                tempTableReservation($connection, 1);
            }
        }
    }

    echo '<form method="post" action="" id="form' . $formId . '" name="form' . $formId . '">';
    $combinedArray = array_combine($formArray, $formDataArray);
    echo '<h1> ' . $testTitle . ' </h1> ';
    foreach ($combinedArray as $key => $value) {
        if ($key != "payment") {
            echo '<label for="' . $key . '">' . $key . '</label> <br>';
            if ($key == "employee_id" || $key == "customer_id") {
                echo '<input type="text" name="';
            } else if ($key == "date" || $key == "check_in" || $key == "check_out") {
                echo '<input type="date" name="';
            } else if ($key == "time") {
                echo '<input type="time" name="';
            } else if ($key == "num_guests") {
                echo '<input type="number" name="';
            }
            echo $key . '" id="' . $key . '" value=' . $value . '> <br>';
        }
        if ($key == "payment") {
            echo '<p1> payment </p1> <br> <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br> ';
        }
    }
    echo '<input type="submit" name="submit' . $formId . '" value="Submit" form="form' . $formId . '">';
    echo '</form>';
}