<?php

// Check for rooms or restaurant

function newReservationDisplay($reservations_id, $isRoom, $connection)
{
    require_once "../common.php";
    include_once "dataBaseFunctions.php";

    $temp_array = searchDB($connection, "reservations", "reservations_id", $reservations_id);

    if ($isRoom) {
            // Search roomReservations table for data
            $temp_array = $temp_array + searchDB($connection, "roomreservations", "reservations_id", $reservations_id);

            // Search room table for data
            $temp_array = $temp_array + searchDB($connection, "rooms", "room_id", $temp_array['room_id']);
    } else {
        // Search tableReservations table for data
        $temp_array = $temp_array + searchDB($connection, "tableReservations", "reservations_id", $reservations_id);

        // Search restaurantTables table for data
        $temp_array = $temp_array + searchDB($connection, "restaurantTables", "table_id", $temp_array['table_id']);
    }

    return $temp_array;
}