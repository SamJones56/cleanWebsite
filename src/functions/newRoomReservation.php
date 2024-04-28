<?php

use hotel\RoomReservations;

// This function creates
function tempRoomReservation($connection, $tester)
{
    require_once "../common.php";
    include_once "../src/functions/dataBaseFunctions.php";
    // Get form data
    $tempRoomReservation = [
        'employee_id' => escape($_POST['employee_id']),
        'customer_id' => escape($_POST['customer_id']),
        'date' => escape($_POST['date']),
        'check_in' => escape($_POST['check_in']),
        'check_out' => escape($_POST['check_out']),
        'payment' => escape($_POST['payment']),
        'num_guests' => escape($_POST['num_guests'])
    ];
    // Get the room price from the DB
    if (strtotime($tempRoomReservation['check_out']) > strtotime($tempRoomReservation['check_in'])) {
        $tempRoomReservation['room_id'] = checkRoomAvailability($connection, $tempRoomReservation['check_in'], $tempRoomReservation['check_out']);

        $initialRoomPrice = getAssociationKey($connection, "rooms", $tempRoomReservation['room_id'], "room_id", "price");
        $tempRoomReservation['roomPrice'] = roomPriceCalculator($connection, $initialRoomPrice, strtotime($tempRoomReservation['check_in']), strtotime($tempRoomReservation['check_out']));
        $_SESSION['temp_room_reservation'] = $tempRoomReservation;
        if ($tempRoomReservation['room_id']) {
            if ($tempRoomReservation['employee_id'] < 1 || $tempRoomReservation['customer_id'] < 1 || !is_numeric($tempRoomReservation['employee_id']) || !is_numeric($tempRoomReservation['customer_id'])) {
                echo "<br> <h1 style='color: red'> Please enter valid id's</h1>";
            } else if ($tempRoomReservation['num_guests'] < 1) {
                echo "<br> <h1 style='color: red'> Number of guests must be greater than 0</h1>";
            } else if (!$tempRoomReservation['check_in'] || !$tempRoomReservation['check_out']) {
                echo "<br> <h1 style='color: red'> Please enter valid check in/out date</h1>";
            } else if ($tempRoomReservation['date'] == 0) {
                echo "<br> <h1 style='color: red'> Error in host date </h1>";
            } else if ($tester == 0) {
                header("location: cart.php");
//                var_dump($tempRoomReservation['room_id']);
//                var_dump($_SESSION['temp_room_type']);
            } // For the purpose of testing
            else if ($tester == 1) {
                newRoomReservation($connection, $tempRoomReservation, 100, $tester);
            }
        } else {
            echo "<h1 style='color: red'> Error in generating room_id </h1>";
        }
    } else {
        echo "<h1 style='color: red'> Check out bust be later than check in </h1>";
    }
}

function newRoomReservation($connection, $tempRoomReservation, $total, $tester)
{
    require_once '../src/DBconnect.php';
    // Check if the form is submitted
    try {
        var_dump($tempRoomReservation);
        require_once "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once "../src/hotel/RoomReservations.php";
        $roomReservation = new RoomReservations();
        $roomReservation->setEmployeeId($tempRoomReservation['employee_id']);
        $roomReservation->setCustomerId($tempRoomReservation['customer_id']);
        addToTable($connection, $roomReservation->toReservationsArray(), 'reservations');
        $roomReservation->setReservationsId(getKey($connection, "reservations", "reservations_id"));
        if (empty($tempRoomReservation['date'])) {
            $roomReservation->setDate(date('Y-m-d'));
        } else {
            $roomReservation->setDate($tempRoomReservation['date']);
        }
        $roomReservation->setCheckIn($tempRoomReservation['check_in']);
        $roomReservation->setCheckOut($tempRoomReservation['check_out']);
        $roomReservation->setPayment($tempRoomReservation['payment']);
        $roomReservation->setRoomId($tempRoomReservation['room_id']);
        // Get the room price
        $roomReservation->setTotalPrice($total);
        $roomReservation->setNumGuests($tempRoomReservation['num_guests']);
        $roomReservation->setCheckedIn(0);
        $initialRoomPrice = $roomReservation->getTotalPrice();

        addToTable($connection, $roomReservation->toRoomReservationsArray(), 'roomreservations');

        echo "<br> <h1>Reservations array</h1>";
        var_dump($roomReservation->toRoomReservationsArray());
        echo "Reservation added successfully.";
        echo "<br>";
        unset($_SESSION['cart']);
        unset($_SESSION['temp_room_reservation']);
        if ($tester == 1) {
            header("location:profile.php");
        }
        if ($_SESSION['permissionlvl'] == 0) {
            header("location:index.php");
        }

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
        echo "<h1> ERROR AT NEW ROOM RESERVATION</h1>";
        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
    }
//    }
}

function checkRoomAvailability($connection, $check_in, $check_out)
{
    $roomType = $_SESSION['temp_room_type'];
    // Get an associated array of all room types and their id's
    $availableRooms = getArr($connection, $roomType, $check_in, $check_out);
    if ($availableRooms) {
        return $availableRooms[0]['room_id'];
    } else {

        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
        echo "<h1>DATE/TIME IS UNAVAILABLE</h1>";
    }
}


function getArr($connection, $roomType, $check_in, $check_out): array
{
    $roomsArray = searchAllDB($connection, "rooms", "room_type", $roomType);
    $availableRooms = [];
    foreach ($roomsArray as $room) {
        $bookingsArray = searchAllDB($connection, "roomreservations", "room_id", $room['room_id']);
        $isAvailable = true;
        foreach ($bookingsArray as $booking) {
            // Check dates
            $bookedCheckIn = strtotime($booking['check_in']);
            $bookedCheckOut = strtotime($booking['check_out']);
            $newCheckIn = strtotime($check_in);
            $newCheckOut = strtotime($check_out);
            // Check if dates conflict
            if ($newCheckIn < $bookedCheckOut && $newCheckOut > $bookedCheckIn) {
                $isAvailable = false;
            }
        }
        if ($isAvailable) {
            $availableRooms[] = $room;
        }
    }
    return $availableRooms;
}

function checkRoomAvailabilityGivenRoom($connection, $roomType, $check_in, $check_out)
{
    // Get an associated array of all room types and their id's
    $availableRooms = getArr($connection, $roomType, $check_in, $check_out);

    if ($availableRooms) {
        return $availableRooms[0]['room_id'];
    } else {
        deleteData($connection, "reservations", "reservations_id", getKey($connection, "reservations", "reservations_id"));
        echo "<h1>DATE IS UNAVAILABLE</h1>";
    }
}

function roomPriceCalculator($connection, $initialRoomPrice, $checkIn, $checkOut)
{
    // Get the range of dates
    $dateRange = [];
    $selectedDate = $checkIn;
    while ($selectedDate <= $checkOut) {
        $dateRange[] = $selectedDate;
//        https://stackoverflow.com/questions/11076334/php-strtotime-add-hours
        $selectedDate = strtotime('+1 day', $selectedDate);
    }
    // Get entries from the discount table
    $count = getKey($connection, "discounts", "discount_id");
    $discountArray = [];
    for ($i = 0; $i <= $count; $i++) {
        $tempDiscount = searchDB($connection, "discounts", "discount_id", $i);
        if ($tempDiscount) {
            $discountArray[] = $tempDiscount;
        }

    }
//  Get count : https://www.w3schools.com/php/func_array_count.asp#:~:text=Definition%20and%20Usage,of%20elements%20in%20an%20array.
    // Apply discount
    $finalPrice = $initialRoomPrice * count($dateRange);
    foreach ($discountArray as $discount) {
        $discountStart = strtotime($discount['startDate']);
        $discountEnd = strtotime($discount['endDate']);
        $amount = $discount['amount'];
        // Check for matching dates
        foreach ($dateRange as $date) {
            if ($date >= $discountStart && $date <= $discountEnd) {
                $finalPrice -= ($initialRoomPrice * $amount);
            }
        }
    }
    return $finalPrice;
}

function addExtras($cartItems, $connection)
{
    $reservation_id = getKey($connection, "reservations", "reservations_id");
    foreach ($cartItems as $key => $value) {
        $newKey = $key + 1;
        $dbCart[$newKey] = $value;
        $tempArray = [
            'option_id' => $newKey,
            'count' => $value,
            'reservations_id' => $reservation_id
        ];
        addToTable($connection, $tempArray, "roomExtras");
    }
}

// Build booking persistence
function bookingRestore($formArray, $formDataArray)
{
    unset($formDataArray['room_id']);
    unset($formDataArray['roomPrice']);
    // Combining an array
//    Array Combine
//  https://www.w3schools.com/php/func_array_combine.asp
    $combinedArray = array_combine($formArray, $formDataArray);
    foreach ($combinedArray as $key => $value) {
        if ($key != "payment") {
            echo '<label ';
            if (!$_SESSION['isEmployee'] && ($key == "employee_id" || $key == "customer_id" || $key == "date")) {
                echo ' hidden ';
            } else if ($_SESSION['isEmployee'] && $key == 'date') {
                echo 'hidden';
            }
            echo ' for="' . $key . '">' . $key . '</label>';
            if ($key == "employee_id" || $key == "customer_id") {
                // Employee_id and customer_id input
                echo '<input class="form-control" type="text" name="' . $key . '" id="' . $key . '" ';
                // Check if employee
                if (!$_SESSION['isEmployee']) {
                    // If not an employee, hide and set default values
                    echo 'value="';
                    if ($key == 'employee_id') {
                        echo '1';
                    } else {
                        echo $formDataArray['customer_id'];
                    }
                    echo '" readonly hidden> <br>';
                } else {
                    // For employees, show current value
                    echo 'value="' . $value . '"> <br>';
                }
            } // Rest of the form
            else if ($key == "date" || $key == "check_in" || $key == "check_out") {
                if ($key == "date") {
                    echo '<br> <input class="form-control" type="date" name="';
                    echo $key . '" value ="' . date('Y-m-d') . ' " hidden > ';
                } else {
                    echo '<br> <input class="form-control" type="date" name="';
                    echo $key . '" id="' . $key . '" value=' . $value . '> ';
                }
            } else if ($key == "num_guests") {
                echo '<br> <input class="form-control" type="number" name="';
                echo $key . '" id="' . $key . '" value=' . $value . '> <br>';
            }
        }
        if ($key == "payment") {
            echo '<p1> payment </p1> <br> <select class="form-control" name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br> ';
        }
    }
}
