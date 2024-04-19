<?php
use hotel\RoomReservations;
// Save form data
function tempRoomReservation($connection, $tester)
{
    require_once "../common.php";
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
        if($tempRoomReservation['room_id'] && $tempRoomReservation['num_guests'] > 0 && $tester == 0){
            header("location: cart.php");
        }
        if($tempRoomReservation['employee_id']<1 || $tempRoomReservation['customer_id']<1 || !is_numeric($tempRoomReservation['employee_id'])|| !is_numeric($tempRoomReservation['customer_id']))
        {
            echo "<br> <h1> Please enter valid id's</h1>";
        }
        if($tempRoomReservation['num_guests'] < 1)
        {
            echo "<br> <h1> Number of guests must be greater than 0</h1>";
        }
        if (!$tempRoomReservation['check_in'] || !$tempRoomReservation['check_out'] || (strtotime($tempRoomReservation['check_in']) > strtotime($tempRoomReservation['check_out'])) )
        {
            echo "<br> <h1> Please enter valid check in/out date</h1>";
        }
        // For the purpose of testing
        if ($tester == 1)
        {
            newRoomReservation($connection, $tempRoomReservation, 100);
        }
    }
}

function newRoomReservation($connection, $tempRoomReservation, $total)
{
    require_once '../src/DBconnect.php';
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        try {
            require_once "../common.php";
            include_once "../src/functions/dataBaseFunctions.php";
            require_once "../src/hotel/RoomReservations.php";
            $roomReservation = new RoomReservations();
            $roomReservation->setEmployeeId($tempRoomReservation['employee_id']);
            $roomReservation->setCustomerId($tempRoomReservation['customer_id']);
            addToTable($connection, $roomReservation->toReservationsArray(), 'reservations');
            $roomReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
            $roomReservation->setDate($tempRoomReservation['date']);
            $roomReservation->setCheckIn($tempRoomReservation['check_in']);
            $roomReservation->setCheckOut($tempRoomReservation['check_out']);
            $roomReservation->setPayment($tempRoomReservation['payment']);
            $roomReservation->setRoomId(checkRoomAvailability($connection, $tempRoomReservation['check_in'], $tempRoomReservation['check_out']));
            // Get the room price
            $roomReservation->setTotalPrice($total);
            $roomReservation->setNumGuests($tempRoomReservation['num_guests']);
            $roomReservation->setCheckedIn(0);
            $initialRoomPrice = $roomReservation->getTotalPrice();
            addToTable($connection, $roomReservation->toRoomReservationsArray(), 'roomreservations');
            echo "Reservation added successfully.";
            unset($_SESSION['cart']);
            unset($_SESSION['temp_room_reservation']);
            if($_SESSION['permissionlvl']>0)
            {
//                header("location:profile.php");
            }

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

function checkRoomAvailabilityGivenRoom($connection, $roomType, $check_in, $check_out)
{
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
//    // Check and see if it is within Christmas dates
//    $dateRange = [];
//    $dateRange = $checkIn;
//    $dateRange = $checkOut;
//
//    // Christmas date checker
//    if(roomDateRangeDeals(11,12,$dateRange))
//    {
//        // Calculate days and total price
//        $days = ceil(abs($checkOut - $checkIn) / 86400);
//        return $roomPrice = ($initialRoomPrice*0.5) * $days;
//    }
//    else
//    {
//        // Calculate days and total price
//        $days = ceil(abs($checkOut - $checkIn) / 86400);
//        return $roomPrice = $initialRoomPrice * $days;
//    }

    $days = ceil(abs($checkOut - $checkIn) / 86400);
    return $roomPrice = $initialRoomPrice * $days;
}

//https://codereview.stackexchange.com/questions/255002/checking-if-an-array-of-dates-are-within-a-date-range#:~:text=I%20created%20a%20dates_in_range(),%2C%20it'll%20return%20false.
function roomDateRangeDeals(int $start, int $end, array $dateRange): bool
{
    foreach ( $dateRange as $date ) {
        $mon = date("m", $date);
        $mon = (int)$mon;
        if ( $mon < $start || $mon > $end ) {
            return false;
        }
    }
    return true;
}

