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
            $restaurantReservation->setRestaurantTableId(escape($_POST['table_id']));

            echo "<br> array:";

//            var_dump($restaurantReservation);

            addToTable($connection, $restaurantReservation->toTableReservationsArray(), 'tablereservations');

        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }

    }
}