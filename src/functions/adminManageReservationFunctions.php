<?php

function buildReservationGeneralList($connection): array
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    $count = getKey($connection, "reservations", "reservations_id");
    $reservationArray = [];
    for ($i = 0; $i <= $count; $i++) {
        $roomReservation = searchDB($connection, "roomreservations", "reservations_id", $i);
        $tableReservation = searchDB($connection, "tablereservations", "reservations_id", $i);

        // Check for employee - control what is displayed
        if ($roomReservation) {
            $reservations_id = $roomReservation["reservations_id"];
            $isRoom = true;
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
            $reservationArray[] = $tempArray;
        }
        if ($tableReservation)
        {
            $reservations_id = $tableReservation["reservations_id"];
            $isRoom = false;
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
            $reservationArray[] = $tempArray;

        }
    }
    return $reservationArray;
}

function buildRoomReservationUserList($connection, $user_id, $isEmployee)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    if ($isEmployee) {
        $reservations = searchAllDB($connection, "reservations", "employee_id", $user_id);
    } else {
        $reservations = searchAllDB($connection, "reservations", "customer_id", $user_id);
    }


    // Check for employee - control what is displayed
    if (is_array($reservations)) {
        foreach ($reservations as $reservation) {
            if (isset($reservation["reservations_id"])) {
                $isRoomRes = searchDB($connection, "roomreservations", "reservations_id", $reservation['reservations_id']);
                if ($isRoomRes) {
                    $reservations_id = $reservation["reservations_id"];
                    $isRoom = true;
                    $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
                    buildRoomReservationDisplay($tempArray, $connection);
                }
            }
        }
    }
}

function buildRestaurantReservationList($connection, $user_id, $isEmployee)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    if ($isEmployee) {
        $reservations = searchAllDB($connection, "reservations", "employee_id", $user_id);
    } else {
        $reservations = searchAllDB($connection, "reservations", "customer_id", $user_id);
    }

// Check for employee - control what is displayed
    if (is_array($reservations)) {
//        reservations_id
        foreach ($reservations as $reservation) {
            if (isset($reservation["reservations_id"])) {
                $tempArray = searchDB($connection, "tablereservations", "reservations_id", $reservation['reservations_id']);
                if ($tempArray) {
                    $reservations_id = $reservation["reservations_id"];
                    $isRoom = true;
//                var_dump($reservations_id);
                    $tempArray = $tempArray + newReservationDisplay($reservations_id, $isRoom, $connection);
                    buildRestaurantReservationDisplay($tempArray, $connection);
                }
            }
        }
    }
}

// Building room bookings table
function buildRoomReservationDisplay($tempArray, $connection)
{
    include_once "dataBaseFunctions.php";
    if(isset($_POST['submit_room'])){
        $temp_res = $_POST['reservations_id'];
//        echo("TempRes" . $temp_res);
        $_SESSION['temp_res'] = $temp_res;
        $_SESSION['isRoom'] = true;
        header("Location: updateReservation.php");
//        exit();
    }
    if(isset($_POST['check_in']))
    {
        $temp_res = $_POST['reservations_id'];
        updateColumn($connection, "roomReservations", "checked_in", "1", "reservations_id", $temp_res);
        header("refresh:0");
    }
    else if(isset($_POST['check_out']))
    {
        $temp_res = $_POST['reservations_id'];
        updateColumn($connection, "roomReservations", "checked_in", "0", "reservations_id", $temp_res);
        header("refresh:0");
    }

    else if(isset($_POST['cancel_room']))
    {
        $temp_res = $_POST['reservations_id'];
        deleteData($connection, "roomextras","reservations_id",$temp_res);
        deleteData($connection, "roomreservations","reservations_id",$temp_res);
        deleteData($connection, "reservations","reservations_id",$temp_res);
        header("refresh:0");
    }

    // Keys that match headers
    $keys = ['reservations_id', 'employee_id', 'customer_id', 'date', 'check_in', 'check_out', 'total_price', 'room_id', 'num_guests', 'checked_in'];

    echo "<tr>";
    foreach ($keys as $key) {
//        https://www.w3schools.com/php/func_array_key_exists.asp
        // Check if the key exists in the userArray
        if (array_key_exists($key, $tempArray)) {
            echo "<td>" . $tempArray[$key] . "</td>";
        } else {
            // Doesn't match
            echo "<td></td>";
        }
    }

    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="reservations_id" value="' . ($tempArray['reservations_id']) . '">';
//    var_dump($tempArray['reservations_id']);
    echo '</td> <td>';
    echo '<input type="submit" name="submit_room" value="Edit">';
    echo '</td> <td>';
    echo '<input type="submit" name="check_in" value="Check in">';
    echo '</td> <td>';
    echo '<input type="submit" name="check_out" value="Check out">';
    echo '</td> <td>';
    echo '<input type="submit" name="cancel_room" value="Cancel">';
    echo '</form></td>';
    echo "</tr>";
}

// Building restaurant bookings table
function buildRestaurantReservationDisplay($tableArray, $connection)
{
    if(isset($_POST['submit_table'])){
        $temp_res = $_POST['reservations_id'];
//        echo("TempRes" . $temp_res);
        $_SESSION['temp_res'] = $temp_res;
        $_SESSION['isRoom'] = false;
        header("Location: updateReservation.php");
//        exit();
    }
    if(isset($_POST['cancel_table'])){
        $temp_res = $_POST['reservations_id'];
        deleteData($connection, "tablereservations","reservations_id",$temp_res);
        deleteData($connection, "reservations","reservations_id",$temp_res);
        header("refresh:0");
    }
    // Keys that match headers
    $keys = ['reservations_id', 'employee_id', 'customer_id', 'date', 'time', 'table_id', 'no_guests'];

    echo "<tr>";
    foreach ($keys as $key) {
        // Check if the key exists in the userArray
        if (array_key_exists($key, $tableArray)) {
            echo "<td>" . $tableArray[$key] . "</td>";

        } else {
            // Doesn't match
            echo "<td></td>";
        }
    }
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="reservations_id" value="' . ($tableArray['reservations_id']) . '">';
//    var_dump($tempArray['reservations_id']);
    echo '</td> <td>';
    echo '<input type="submit" name="submit_table" value="Edit">';
    echo '</td> <td>';
    echo '<input type="submit" name="cancel_table" value="Cancel">';
    echo '</form></td>';
    echo "</tr>";
}