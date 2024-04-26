<?php

// This function is called to build a General List of ALL reservations, searching the database and returning an Array of all reservations
function buildReservationGeneralList($connection): array
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
    // Get a count of all reservations
    $count = getKey($connection, "reservations", "reservations_id");
    $reservationArray = [];
    // Loop through the reservations
    for ($i = 0; $i <= $count; $i++) {
        // Search the databse for the resepective reservation types and save
        $roomReservation = searchDB($connection, "roomreservations", "reservations_id", $i);
        $tableReservation = searchDB($connection, "tablereservations", "reservations_id", $i);
        // Check for type of reservation
        if ($roomReservation) {
            $reservations_id = $roomReservation["reservations_id"];
            $isRoom = true;
            // Build the display with the gathered data
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
            // Add to the array that will be returned
            $reservationArray[] = $tempArray;
        }
        if ($tableReservation)
        {
            $reservations_id = $tableReservation["reservations_id"];
            $isRoom = false;
            // Build the display with the gathered data
            $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
            // Add to the array that will be returned
            $reservationArray[] = $tempArray;
        }
    }
    // Return the built Array
    return $reservationArray;
}

// This function builds Room Reservations at the user level
function buildRoomReservationUserList($connection, $user_id, $isEmployee)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
    // Check for if it is an employee and search correct table using appropriate id's
    if ($isEmployee) {
        $reservations = searchAllDB($connection, "reservations", "employee_id", $user_id);
    } else {
        $reservations = searchAllDB($connection, "reservations", "customer_id", $user_id);
    }
//  https://www.w3schools.com/php/func_var_is_array.asp#:~:text=Definition%20and%20Usage,otherwise%20it%20returns%20false%2Fnothing.
//    is Array function
    // Check if the $reservations is an array
    if (is_array($reservations)) {
        // Loop through each of the items in the $reservations array
        foreach ($reservations as $reservation) {
            // Check and see if the reservations_id is set
            if (isset($reservation["reservations_id"])) {
                // Searching the database to see if the id is linked to a room or table reservation
                $isRoomRes = searchDB($connection, "roomreservations", "reservations_id", $reservation['reservations_id']);
                // If it is a room reservation
                if ($isRoomRes) {
                    // Set the reservations id
                    $reservations_id = $reservation["reservations_id"];
                    $isRoom = true;
                    // Get the array from the reservation display function
                    $tempArray = newReservationDisplay($reservations_id, $isRoom, $connection);
                    // Build the display
                    buildRoomReservationDisplay($tempArray, $connection);
                }
            }
        }
    }
}

// This function builds an array of restaurant bookings
function buildRestaurantReservationList($connection, $user_id, $isEmployee)
{
    include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
    // Check for if it is an employee and search correct table using appropriate id's
    if ($isEmployee) {
        $reservations = searchAllDB($connection, "reservations", "employee_id", $user_id);
    } else {
        $reservations = searchAllDB($connection, "reservations", "customer_id", $user_id);
    }
//  https://www.w3schools.com/php/func_var_is_array.asp#:~:text=Definition%20and%20Usage,otherwise%20it%20returns%20false%2Fnothing.
// Check if the $reservations is an array
    if (is_array($reservations)) {
        // Loop through each of the items in the $reservations array
        foreach ($reservations as $reservation) {
            // Check and see if the reservations_id is set
            if (isset($reservation["reservations_id"])) {
                // Searching the database to see if the id is linked to a room or table reservation
                $tempArray = searchDB($connection, "tablereservations", "reservations_id", $reservation['reservations_id']);
                if ($tempArray) {
                    // Assign the id
                    $reservations_id = $reservation["reservations_id"];
                    $isRoom = true;
                    // Get the array
                    $tempArray = $tempArray + newReservationDisplay($reservations_id, $isRoom, $connection);
                    // Build the display
                    buildRestaurantReservationDisplay($tempArray, $connection);
                }
            }
        }
    }
}

// This function builds a table with the reservation data
function buildRoomReservationDisplay($tempArray, $connection)
{
    include_once "dataBaseFunctions.php";
    // Handle submission of the form
    if(isset($_POST['submit_room'])){
        $temp_res = $_POST['reservations_id'];
        $_SESSION['temp_res'] = $temp_res;
        $_SESSION['isRoom'] = true;
        // If entry selected was to edit an entry, redirect to appropriate webpage
        header("Location: updateReservation.php");
    }
    // See if check_in is selected
    if(isset($_POST['check_in']))
    {
        // set the temp reservation_id as the forms reservation_id
        $temp_res = $_POST['reservations_id'];
        // update the column in the database with the new data
        updateColumn($connection, "roomReservations", "checked_in", "1", "reservations_id", $temp_res);
        header("refresh:0");
    }
    // See if check_out was selected
    else if(isset($_POST['check_out']))
    {
        // Update the temp reservation
        $temp_res = $_POST['reservations_id'];
        // update the column in the db with the new value
        updateColumn($connection, "roomReservations", "checked_in", "0", "reservations_id", $temp_res);
        header("refresh:0");
    }
    // See if cancel_room was selected
    else if(isset($_POST['cancel_room']))
    {
        // update the temp reservation id with the new value
        $temp_res = $_POST['reservations_id'];
        // delete the data from the necessary tables
        deleteData($connection, "roomextras","reservations_id",$temp_res);
        deleteData($connection, "roomreservations","reservations_id",$temp_res);
        deleteData($connection, "reservations","reservations_id",$temp_res);
        header("refresh:0");
    }
    // Keys that match needed table headers
    $keys = ['reservations_id', 'employee_id', 'customer_id', 'date', 'check_in', 'check_out', 'total_price', 'room_id', 'num_guests', 'checked_in'];
    echo "<tr>";
    // Loop through each of the keys
    foreach ($keys as $key) {
//       https://www.w3schools.com/php/func_array_key_exists.asp
        // Check if the key exists in the userArray
        if (array_key_exists($key, $tempArray)) {
            // Print out the value of the temp array that matches the key value
            echo "<td>" . $tempArray[$key] . "</td>";
        } else {
            // Do nothing if it doesn't match
            echo "<td></td>";
        }
    }
    // Set the form, for use in what options you choose at the end
    echo '<td><form action="" method="post">';
    // Hide the id of each of the table entries
    echo '<input type="hidden" name="reservations_id" value="' . ($tempArray['reservations_id']) . '">';
    // All the different options to interract with each of the entries
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

// This function builds a table with the reservation data
function buildRestaurantReservationDisplay($tableArray, $connection)
{
    // See if the form submission
    if(isset($_POST['submit_table'])){
        $temp_res = $_POST['reservations_id'];
        $_SESSION['temp_res'] = $temp_res;
        $_SESSION['isRoom'] = false;
        // If entry selected was to edit an entry, redirect to appropriate webpage
        header("Location: updateReservation.php");
    }
    // See if cancel table was selected, this deletes the entry from the database
    if(isset($_POST['cancel_table'])){
        $temp_res = $_POST['reservations_id'];
        deleteData($connection, "tablereservations","reservations_id",$temp_res);
        deleteData($connection, "reservations","reservations_id",$temp_res);
        header("refresh:0");
    }
    // Keys that match headers
    $keys = ['reservations_id', 'employee_id', 'customer_id', 'date', 'time', 'table_id', 'no_guests'];
    echo "<tr>";
    // Loop through each of the keys
    foreach ($keys as $key) {
//        https://www.w3schools.com/php/func_array_key_exists.asp
        // Check if the key exists in the userArray
        if (array_key_exists($key, $tableArray)) {
            // If the key exists, print out the associated value within the table array
            echo "<td>" . $tableArray[$key] . "</td>";
        } else {
            // Do nothing if it doesn't match
            echo "<td></td>";
        }
    }
    echo '<td><form action="" method="post">';
    // Hidden id value
    echo '<input type="hidden" name="reservations_id" value="' . ($tableArray['reservations_id']) . '">';
    // Options for dealing with data
    echo '</td> <td>';
    echo '<input type="submit" name="submit_table" value="Edit">';
    echo '</td> <td>';
    echo '<input type="submit" name="cancel_table" value="Cancel">';
    echo '</form></td>';
    echo "</tr>";
}