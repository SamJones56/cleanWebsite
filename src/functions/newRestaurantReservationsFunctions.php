<?php

use hotel\TableReservations;

function newRestaurantReservation()
{
    require_once '../src/DBconnect.php';

    if (isset($_POST['submit'])) {
        try {
            require "../common.php";
            include "../src/functions/dataBaseFunctions.php";
            require_once "../src/hotel/TableReservations.php";

            $restaurantReservation = new TableReservations();

            // Get the data from the form
            $restaurantReservation->setEmployeeId(escape($_POST['employee_id']));
            $restaurantReservation->setCustomerId(escape($_POST['customer_id']));

            addToTable($connection, $restaurantReservation->toReservationsArray(), 'reservations');

            var_dump("Reservation added");


            $restaurantReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));

//            var_dump($restaurantReservation);

//            $restaurantReservation->setTableId();
            $restaurantReservation->setDate(escape($_POST['date']));
            $restaurantReservation->setTime(escape($_POST['time']));
            $restaurantReservation->setNoGuests(escape($_POST['guests']));

            $_SESSION['temp_cap'] = $restaurantReservation->getNoGuests();

            $restaurantReservation->setRestaurantTableId(checkTableAvailability($connection, escape($_POST['time'])));

//            echo "<br> array:";

//            var_dump($restaurantReservation);

            addToTable($connection, $restaurantReservation->toTableReservationsArray(), 'tablereservations');

        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }

    }
}

function checkTableAvailability($connection, $time)
{
    $tableCapacity = $_SESSION['temp_cap'];

    $tableArray = seachAllDBcap($connection, "restauranttables", "capacity", $tableCapacity);

    $availableTables = [];

    foreach($tableArray as $table) {
        $bookingsArray = searchAllDB($connection, "tablereservations", "no_guests", $table['capacity']);

        $isAvailable = true;

        foreach($bookingsArray as $booking)
        {
            // Check dates
            $bookedCheckIn = strtotime($booking['time']);
            $bookedCheckOut = (strtotime($booking['time']))+5400;
            $newCheckIn = strtotime($time);
            $newCheckOut = strtotime($time)+5400;

            // Check if dates conflict
            if($newCheckIn < $bookedCheckOut && $newCheckOut > $bookedCheckIn )
            {
                $isAvailable = false;
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
        header("refresh:0");
    }
}