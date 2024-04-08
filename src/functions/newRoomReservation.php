<?php

use hotel\RoomReservations;

// Save form data
function tempRoomReservation($connection)
{
    require "../common.php";
    if (isset($_POST['submit']))
    {
        include_once "../src/functions/dataBaseFunctions.php";

        // Get form data
        $tempRoomReservation['employee_id'] = escape($_POST['employee_id']);
        $tempRoomReservation['customer_id'] = escape($_POST['customer_id']);
        $tempRoomReservation['date'] = escape($_POST['date']);
        $tempRoomReservation['check_in'] = escape($_POST['check_in']);
        $tempRoomReservation['check_out'] = escape($_POST['check_out']);
        $tempRoomReservation['payment'] = escape($_POST['payment']);
        $tempRoomReservation['num_guests'] = escape($_POST['num_guests']);

        // Get the room price from the DB
        $tempRoomReservation['room_id'] = checkRoomAvailability($connection, $tempRoomReservation['check_in'], $tempRoomReservation['check_out']);

        $initialRoomPrice = getAssociationKey($connection, "rooms", $tempRoomReservation['room_id'], "room_id", "price");


        $tempRoomReservation['roomPrice'] = roomPriceCalculator($initialRoomPrice, strtotime($tempRoomReservation['check_in']), strtotime($tempRoomReservation['check_out']));


        $_SESSION['temp_room_reservation'] =  $tempRoomReservation;

//        var_dump($_SESSION['temp_room_reservation']);
        if($tempRoomReservation['room_id']){
            header("location: cart.php");
        }
    }
}

function newRoomReservation($connection, $tempRoomReservation, $total)
{
    require_once '../src/DBconnect.php';
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        try {
//            error_reporting(E_ALL);
            require "../common.php";
            include_once "../src/functions/dataBaseFunctions.php";
            require_once "../src/hotel/RoomReservations.php";

            $roomReservation = new RoomReservations();

//            var_dump($_POST['employee_id']);

            // Capture form data
//            $roomReservation->setReservationsId(escape($_POST['reservations_id']));
            $roomReservation->setEmployeeId($tempRoomReservation['employee_id']);
            $roomReservation->setCustomerId($tempRoomReservation['customer_id']);

//            var_dump("Post: ");
//            var_dump($_POST);

            addToTable($connection, $roomReservation->toReservationsArray(), 'reservations');

            // Set reservation id
            $roomReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
//
            $roomReservation->setDate($tempRoomReservation['date']);
//            $roomReservation->setRoomId(escape($_POST['room_id']));
            $roomReservation->setCheckIn($tempRoomReservation['check_in']);
            $roomReservation->setCheckOut($tempRoomReservation['check_out']);
            $roomReservation->setPayment($tempRoomReservation['payment']);

            $roomReservation->setRoomId(checkRoomAvailability($connection, $tempRoomReservation['check_in'], $tempRoomReservation['check_out']));

            // Get the room price
            $roomReservation->setTotalPrice($total);
//            $roomReservation->setTotalPrice(escape($_POST['total_price']));
            $roomReservation->setNumGuests($tempRoomReservation['num_guests']);
            $roomReservation->setCheckedIn(0);

            // Do cost calculation
            $initialRoomPrice = $roomReservation->getTotalPrice();

            // Convert to timestamps
//            https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
//            $checkin = strtotime($roomReservation->getCheckIn());
//            $checkout = strtotime($roomReservation->getCheckOut());

            // Calculate days and total price
//            $days = ceil(abs($checkout - $checkin) / 86400);
//            $roomPrice = $initialRoomPrice * $days;

//            $roomPrice = roomPriceCalculator($initialRoomPrice, $checkin, $checkout);
//
//            $roomReservation->setTotalPrice($roomPrice);

            addToTable($connection, $roomReservation->toRoomReservationsArray(), 'roomreservations');

            echo "Reservation added successfully.";

//            $roomReservation->setTotalPrice($roomPrice);


//            checkRoomAvailability($connection, escape($_POST['check_in']), escape($_POST['check_out']));

//            return $roomPrice;
            unset($_SESSION['cart']);
            unset($_SESSION['temp_room_reservation']);
            header("location:profile.php");
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }
}

function checkRoomAvailability($connection, $check_in, $check_out)
{
    $roomType = $_SESSION['temp_room_type'];
    // Get an associated array of all room types and their id's
    $roomsArray = searchAllDB($connection, "rooms", "room_type", $roomType);

    $availableRooms = [];

    foreach($roomsArray as $room) {
        $bookingsArray = searchAllDB($connection, "roomreservations", "room_id", $room['room_id']);

        $isAvailable = true;

        foreach($bookingsArray as $booking)
        {
            // Check dates
            $bookedCheckIn = strtotime($booking['check_in']);
            $bookedCheckOut = strtotime($booking['check_out']);
            $newCheckIn = strtotime($check_in);
            $newCheckOut = strtotime($check_out);
            // Check if dates conflict
            if($newCheckIn < $bookedCheckOut && $newCheckOut > $bookedCheckIn )
            {
                $isAvailable = false;
            }
        }
        if($isAvailable)
        {
            $availableRooms[] = $room;
        }
    }

    if($availableRooms) {
        return $availableRooms[0]['room_id'];
    }
    else
    {
        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
        echo "<h1>DATE/TIME IS UNAVAILABLE</h1>";
    }
}

function roomPriceCalculator($initialRoomPrice, $checkIn, $checkOut)
{
    // Calculate days and total price
    $days = ceil(abs($checkOut - $checkIn) / 86400);
    return $roomPrice = $initialRoomPrice * $days;
}
?>
