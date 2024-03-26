<?php

use hotel\TableReservations;

function newRestaurantReservation()
{
    require_once '../src/DBconnect.php';

    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once "../src/hotel/TableReservations.php";
        $restaurantReservation = new TableReservations();
        try {
            // Get the data from the form
            $restaurantReservation->setEmployeeId(escape($_POST['employee_id']));
            $restaurantReservation->setCustomerId(escape($_POST['customer_id']));

            addToTable($connection, $restaurantReservation->toReservationsArray(), 'reservations');

            $restaurantReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));

            $restaurantReservation->setDate(escape($_POST['date']));
            $restaurantReservation->setTime(escape($_POST['time']));
            $restaurantReservation->setNoGuests(escape($_POST['guests']));

            $_SESSION['temp_cap'] = $restaurantReservation->getNoGuests();

            $restaurantReservation->setRestaurantTableId(checkTableAvailability($connection, escape($_POST['time']),escape($_POST['date'])));

            addToTable($connection, $restaurantReservation->toTableReservationsArray(), 'tablereservations');

        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();

            echo "<br>";
            echo "<br>";
            echo "Catch hit";
//            deleteData($connection, "reservations", "reservation_id", $restaurantReservation->getReservationsId());
        }

    }
}

function checkTableAvailability($connection, $bookingTime, $bookingDate)
{
    $tableCapacity = $_SESSION['temp_cap'];

    $tableArray = seachAllDBcap($connection, "restauranttables", "capacity", $tableCapacity);

    $availableTables = [];

    foreach($tableArray as $table) {
        $bookingsArray = searchAllDB($connection, "tablereservations", "no_guests", $table['capacity']);

        var_dump($bookingsArray);

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
    }
}