<?php

function buildRoomReservationGeneralList($connection)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    $count = getKey($connection, "reservations", "reservations_id");

    for ($i = 0; $i <= $count; $i++) {
        $reservation = searchDB($connection, "reservations", "reservations_id", $i);

        // Check for employee - control what is displayed
        if ($reservation) {
            $reservations_id = $reservation["reservations_id"];
            $isRoom = true;
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
//            echo("<br> Temp array at creation");
//            var_dump($tempArray);
            buildRoomReservationDisplay($tempArray);
        }
    }
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
                $reservations_id = $reservation["reservations_id"];
                $isRoom = true;
                $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
                buildRoomReservationDisplay($tempArray);
            }
        }
    }
}

function buildRestaurantReservationList($connection)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    $count = getKey($connection, "reservations", "reservations_id");

    for ($i = 0; $i <= $count; $i++) {
        $reservation = searchDB($connection, "reservations", "reservations_id", $i);
        if ($reservation) {
            $reservations_id = $reservation['reservations_id']; // Remove $ from $reservations_id
            $isRoom = false;
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
            buildRestaurantReservationDisplay($tempArray);
        }
    }
}

// Building room bookings table
function buildRoomReservationDisplay($tempArray)
{
//    var_dump($tempArray);
//    echo("<br>");
    if(isset($_POST['submit_room'])){
        $temp_res = $_POST['reservations_id'];
        echo("TempRes" . $temp_res);
        $_SESSION['temp_res'] = $temp_res;
        $_SESSION['isRoom'] = true;
        header("Location: updateReservation.php");
        exit();
    }
    // Keys that match headers
    $keys = ['reservations_id', 'employee_id', 'customer_id', 'date', 'check_in', 'check_out', 'total_price', 'room_id', 'num_guests'];

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
    echo '<input type="submit" name="submit_room" value="Edit">';
    echo '</form></td>';
    echo "</tr>";
}

// Building restaurant bookings table
function buildRestaurantReservationDisplay($userArray)
{
//    if(isset($_POST['submit'])){
//        $temp_login = $_POST['user_id'];
//        $_SESSION['temp_login'] = $temp_login;
//        header("Location: updateUser.php");
//        exit();
//    }
    // Keys that match headers
    $keys = ['user_id', 'name', 'address', 'ph_no', 'email', 'dob', 'passport_no'];

    echo "<tr>";
    foreach ($keys as $key) {
        // Check if the key exists in the userArray
        if (array_key_exists($key, $userArray)) {
            echo "<td>" . $userArray[$key] . "</td>";
        } else {
            // Doesn't match
            echo "<td></td>";
        }
    }
//    echo '<td><form action="" method="post">';
//    echo '<input type="hidden" name="user_id" value="' . ($userArray['Login_id']) . '">';
//    echo '<input type="submit" name="submit" value="Edit">';
//    echo '</form></td>';
//    echo "</tr>";
}