<?php
include "../src/Functions/adminManageReservationFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}

$_SESSION['guestRedirect'] = "adminManageReservations.php";
$reservationArray = buildReservationGeneralList($connection);


?>
    <h2>Room Bookings</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Reservation id</th>
            <th scope="col">Employee id</th>
            <th scope="col">Customer id</th>
            <th scope="col">Date</th>
            <th scope="col">Check in</th>
            <th scope="col">Check out</th>
            <th scope="col">Total Price</th>
            <th scope="col">Room id</th>
            <th scope="col">Number of Guests</th>
            <th scope="col">Checked in</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reservationArray as $tableRes) {
            if (isset($tableRes['room_id'])) {
                buildRoomReservationDisplay($tableRes, $connection);
            }
        }
        ?>
        </tbody>
    </table>

    <h2>Restaurant Bookings</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Reservation id</th>
            <th scope="col">Employee id</th>
            <th scope="col">Customer id</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Table id</th>
            <th scope="col">Number of Guests</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reservationArray as $tableRes) {
            if (!isset($tableRes['room_id'])) {
                buildRestaurantReservationDisplay($tableRes, $connection);
            }
        }
        ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary"> Back to admin </a>

<?php include "templates/footer.php"; ?>