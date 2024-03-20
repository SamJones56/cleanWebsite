<?php

use hotel\TableReservations;

function newRestaurantReservation()
{
    require_once '../src/DBconnect.php';

    if (isset($_POST['submit'])) {
        try {
            require "../common.php";
            include "../src/functions/dataBaseFunctions.php";
            require_once "../src/hotel/RoomReservations.php";

            $restaurantReservation = new TableReservations();

            // Get the data from the form
            $restaurantReservation->setReservationsId();





        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }

    }
}