<?php

use hotel\RoomReservations;

function newRoomReservation()
{
    // Include your database connection file
    require_once '../src/DBconnect.php';
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        try {
            error_reporting(E_ALL);
            require "../common.php";
            include "../src/functions/dataBaseFunctions.php";
            require_once "../src/hotel/RoomReservations.php";

            $roomReservation = new RoomReservations();

            var_dump($_POST['employee_id']);

            // Capture form data
//            $roomReservation->setReservationsId(escape($_POST['reservations_id']));
            $roomReservation->setEmployeeId(escape($_POST['employee_id']));
            $roomReservation->setCustomerId(escape($_POST['customer_id']));

            addToTable($connection, $roomReservation->toReservationsArray(), 'reservations');

            // Set reservation id
            $roomReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
//
            $roomReservation->setDate(escape($_POST['date']));
            $roomReservation->setRoomId(escape($_POST['room_id']));
            $roomReservation->setCheckIn(escape($_POST['check_in']));
            $roomReservation->setCheckOut(escape($_POST['check_out']));
            $roomReservation->setPayment(escape($_POST['payment']));
            // Get the room price
            $roomReservation->setTotalPrice(getAssociationKey($connection, "rooms", $roomReservation->getRoomId(), "room_id", "price"));
//            $roomReservation->setTotalPrice(escape($_POST['total_price']));
            $roomReservation->setNumGuests(escape($_POST['num_guests']));
            $roomReservation->setCheckedIn(0);

            // Do cost calculation
            $initialRoomPrice = $roomReservation->getTotalPrice();

            // Convert to timestamps
            $checkin = strtotime($roomReservation->getCheckIn());
            $checkout = strtotime($roomReservation->getCheckOut());

            // Calculate days and total price
            $days = ceil(abs($checkout - $checkin) / 86400);
            $roomPrice = $initialRoomPrice * $days; // Assuming $initialRoomPrice is your daily rate

            $roomReservation->setTotalPrice($roomPrice);

            addToTable($connection, $roomReservation->toRoomReservationsArray(), 'roomreservations');

            echo "Reservation added successfully.";

            $roomReservation->setTotalPrice($roomPrice);

            return $roomPrice;
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }
}

?>
