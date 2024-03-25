<?php

// Check for rooms or restaurant

function newReservationDisplay($reservations_id, $isRoom, $connection)
{
    require_once "../common.php";
    include_once "dataBaseFunctions.php";

    $temp_array = searchDB($connection, "reservations", "reservations_id", $reservations_id);

    if ($isRoom) {
        try {
            // Search roomReservations table for data
            $temp_array = $temp_array + searchDB($connection, "roomreservations", "reservations_id", $reservations_id);

            // Search room table for data
            $temp_array = $temp_array + searchDB($connection, "rooms", "room_id", $temp_array['room_id']);
        } catch (TypeError $error)
        {

        }
    } else {
        // Search tableReservations table for data
        $temp_array = $temp_array + searchDB($connection, "tableReservations", "reservations_id", $reservations_id);

        // Search restaurantTables table for data
        $temp_array = $temp_array + searchDB($connection, "restaurantTables", "table_id", $temp_array['table_id']);
    }

//    var_dump($temp_array);
    return $temp_array;
}

use hotel\TableReservations;
use hotel\RoomReservations;

function buildReservation($resArray, $isRoom, $connection)
{
    require_once "../common.php";
    include_once "dataBaseFunctions.php";
    require_once '../src/hotel/TableReservations.php';
    require_once '../src/hotel/RoomReservations.php';

    if(!$isRoom){
        $tableRes = new TableReservations();
        // Update $tableRes with new data, value is passed by reference so it can be changed
//        https://www.php.net/manual/en/language.references.pass.php
        foreach($resArray as $key => &$value) {
            // Logic to find a change
            if (isset($_POST[$key]) && $value != $_POST[$key]) {
                // Update the value to the correct value in the form
                $value = $_POST[$key];
            }
        }

//        var_dump($resArray);
        $tableRes -> setFilledTableRes($resArray);

        updateTable($connection, $tableRes->toReservationsArray(),"reservations", "reservations_id", $resArray['reservations_id']);
        echo "<br>";
        updateTable($connection, $tableRes->toTableReservationsArray(),"tablereservations", "reservations_id", $resArray['reservations_id']);
        echo "<br>";
//        var_dump("update tabletable");
//        var_dump($tableRes);
    }
    header("Refresh:0");
 } ?>