<?php

use hotel\TableReservations;

function tempTableReservation($connection, $tester)
{
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    // Build temp reservation
    $tempTableReservation = [
        'employee_id' => escape($_POST['employee_id']),
        'customer_id' => escape($_POST['customer_id']),
        'date' => escape($_POST['date']),
        'time' => escape($_POST['time']),
        'num_guests' => escape($_POST['num_guests'])
    ];
    // Check if table is available
    $tempTableReservation['table_id'] = checkTableAvailability($connection, $tempTableReservation['time'], $tempTableReservation['date'], $tempTableReservation['num_guests']);
    // Check if the table id was set
    if ($tempTableReservation['table_id']) {
        // Check for invalid id
        if ($tempTableReservation['employee_id'] < 1 || $tempTableReservation['customer_id'] < 1 || !is_numeric($tempTableReservation['employee_id']) || !is_numeric($tempTableReservation['customer_id'])) {
            echo "<br> <h1 style='color: red'> Please enter valid id's</h1>";
        } // Check for invalid number of guest
        else if ($tempTableReservation['num_guests'] < 1) {
            echo "<br> <h1 style='color: red'> Number of guests must be greater than 0</h1>";
        } // Check for invalid date and time
        else if (!$tempTableReservation['date'] || !$tempTableReservation['time']) {
            echo "<br> <h1 style='color: red'> Please enter valid date and time</h1>";
        } else {
            // Create a new reservation
            newRestaurantReservation($connection, $tempTableReservation, $tester);
        }
    } else {
        echo "<h1 style='color: red'> Error in generating table_id </h1>";
    }
}

// This function creates a new reservation
function newRestaurantReservation($connection, $tempTableReservation, $tester)
{
    require_once '../src/DBconnect.php';
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    require_once "../src/hotel/TableReservations.php";
    // Create new reservation object
    $restaurantReservation = new TableReservations();
    try {
        // Get the data from the array
        $restaurantReservation->setEmployeeId($tempTableReservation['employee_id']);
        $restaurantReservation->setCustomerId($tempTableReservation['customer_id']);
        // Add the data to the table
        addToTable($connection, $restaurantReservation->toReservationsArray(), 'reservations');
        // Get the data from the array
        $restaurantReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
        $restaurantReservation->setDate($tempTableReservation['date']);
        $restaurantReservation->setTime($tempTableReservation['time']);
        $restaurantReservation->setNoGuests($tempTableReservation['num_guests']);
        $restaurantReservation->setRestaurantTableId($tempTableReservation['table_id']);
        // Add the data to the table
        addToTable($connection, $restaurantReservation->toTableReservationsArray(), 'tablereservations');
        // Check if a tester
        if ($tester == 1) {
            header("location:profile.php");
        } else if ($tester == 0) {
            // Check for  tester
            echo '<p1> Reservation added successfully</p1>';
        }

        echo "<br>";
        echo "<br>";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();

    }
}

// This function checks if the room is available
function checkTableAvailability($connection, $bookingTime, $bookingDate, $num_guests)
{
    // Checks the cap of the rooms
    if ($num_guests <= 2) {
        $cap = 2;
    } else if ($num_guests <= 4) {
        $cap = 4;
    } else if ($num_guests <= 6) {
        $cap = 6;
    } else if ($num_guests <= 10) {
        $cap = 10;
    } else {
        $cap = 12;
    }
    // Search all the table for the correct capacity
    $tableArray = seachAllDBcap($connection, "restauranttables", "capacity", $cap);
    $availableTables = [];
    // Loop through the table array and get each table object
    foreach ($tableArray as $table) {
        // Create a bookings array from the data in the database
        $bookingsArray = searchAllDB($connection, "tablereservations", "table_id", $table['table_id']);
        $isAvailable = true;
        // Loop through this new array for each booking object
        foreach ($bookingsArray as $booking) {
            // Check dates
            $bookedDate = strtotime($booking['date']);
            // Generate the new dates
            $newDate = strtotime($bookingDate);
            // if the dates match, change
            if ($bookedDate == $newDate) {
                $bookedStart = strtotime($booking['time']);
                $bookedEnd = $bookedStart + 5400;
                $newStart = strtotime($bookingTime);
                $newEnd = $newStart + 5400;
                if ($newStart < $bookedEnd && $newEnd > $bookedStart) {
                    $isAvailable = false;
                }
            }
        }
        if ($isAvailable) {
            $availableTables[] = $table;
        }
    }
    if ($availableTables) {
        return $availableTables[0]['table_id'];
    } else {
        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
        echo "<h1>DATE/TIME IS UNAVAILABLE</h1>";
    }
}