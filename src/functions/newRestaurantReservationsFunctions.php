<?php

use hotel\TableReservations;

function tempTableReservation($connection, $tester)
{
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    $tempTableReservation = [
        'employee_id' => escape($_POST['employee_id']),
        'customer_id' => escape($_POST['customer_id']),
        'date' => escape($_POST['date']),
        'time' => escape($_POST['time']),
        'num_guests' => escape($_POST['num_guests'])
    ];

    // Check if table is available
    $tempTableReservation['table_id'] = checkTableAvailability($connection, $tempTableReservation['time'], $tempTableReservation['date'], $tempTableReservation['num_guests']);
    if($tempTableReservation['table_id'])
    {
        if ($tempTableReservation['employee_id'] < 1 || $tempTableReservation['customer_id'] < 1 || !is_numeric($tempTableReservation['employee_id']) || !is_numeric($tempTableReservation['customer_id'])) {
            echo "<br> <h1 style='color: red'> Please enter valid id's</h1>";
        }
        else if ($tempTableReservation['num_guests'] < 1) {
            echo "<br> <h1 style='color: red'> Number of guests must be greater than 0</h1>";
        }
        else if (!$tempTableReservation['date'] || !$tempTableReservation['time']) {
            echo "<br> <h1 style='color: red'> Please enter valid date and time</h1>";
        }
        else
        {
            newRestaurantReservation($connection, $tempTableReservation ,$tester);
        }
    }
    else
    {
        echo "<h1 style='color: red'> Error in generating table_id </h1>";
    }
}
function newRestaurantReservation($connection, $tempTableReservation ,$tester)
{
    require_once '../src/DBconnect.php';

        require_once "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once "../src/hotel/TableReservations.php";
        $restaurantReservation = new TableReservations();
        try {
            // Get the data from the form
            $restaurantReservation->setEmployeeId($tempTableReservation['employee_id']);
            $restaurantReservation->setCustomerId($tempTableReservation['customer_id']);
            addToTable($connection, $restaurantReservation->toReservationsArray(), 'reservations');
            $restaurantReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
            $restaurantReservation->setDate($tempTableReservation['date']);
            $restaurantReservation->setTime($tempTableReservation['time']);
            $restaurantReservation->setNoGuests($tempTableReservation['num_guests']);
            $restaurantReservation->setRestaurantTableId($tempTableReservation['table_id']);
//            $_SESSION['temp_cap'] = $restaurantReservation->getNoGuests();
//            $restaurantReservation->setRestaurantTableId(checkTableAvailability($connection, $restaurantReservation->getTime(),$restaurantReservation->getDate()));
            addToTable($connection, $restaurantReservation->toTableReservationsArray(), 'tablereservations');
//            var_dump($restaurantReservation);
            if ($tester == 1) {
                header("location:profile.php");
            }
            else if ($tester == 0){
                echo '<p1> Reservation added successfully</p1>';
            }

            echo "<br>";
            echo "<br>";
//            var_dump($_SESSION['customer_id']);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();

        }
}

function checkTableAvailability($connection, $bookingTime, $bookingDate, $num_guests)
{
    if ($num_guests <= 2)
    {
        $cap = 2;
    }
    else if ($num_guests <= 4)
    {
        $cap = 4;
    }
    else if ($num_guests <= 6)
    {
        $cap = 6;
    }
    else if ($num_guests <= 10)
    {
        $cap = 10;
    }
    else{
        $cap = 12;
    }
    $tableArray = seachAllDBcap($connection, "restauranttables", "capacity", $cap);
    $availableTables = [];
    foreach($tableArray as $table) {
        $bookingsArray = searchAllDB($connection, "tablereservations", "table_id", $table['table_id']);
        $isAvailable = true;
        foreach($bookingsArray as $booking)
        {
            // Check dates
            $bookedDate = strtotime($booking['date']);
            $newDate = strtotime($bookingDate);
            if($bookedDate == $newDate) {
                $bookedStart = strtotime($booking['time']);
                $bookedEnd = $bookedStart + 5400;
                $newStart = strtotime($bookingTime);
                $newEnd = $newStart + 5400;
                if ($newStart < $bookedEnd && $newEnd > $bookedStart) {
                    $isAvailable = false;
                }
            }
        }
        if($isAvailable)
        {
            $availableTables[] = $table;
        }
    }
    if($availableTables) {
        return $availableTables[0]['table_id'];
    }
    else
    {
        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
        echo "<h1>DATE/TIME IS UNAVAILABLE</h1>";
    }
}