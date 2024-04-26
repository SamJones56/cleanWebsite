<?php
include "../src/Functions/adminManageReservationFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}

$_SESSION['guestRedirect'] = "adminManageReservations.php";
$reservationArray = buildReservationGeneralList($connection);


?>
    <h2>Room Bookings</h2>
    <table>
        <thead>
        <tr>
            <th>Reservation id</th>
            <th>Employee id</th>
            <th>Customer id</th>
            <th>Date</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Total Price</th>
            <th>Room id</th>
            <th>Number of Guests</th>
            <th>Checked in</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($reservationArray as $tableRes){
                if(isset($tableRes['room_id'])){
                    buildRoomReservationDisplay($tableRes, $connection);
                }
            }
        ?>
        </tbody>
    </table>

    <h2>Restaurant Bookings</h2>
    <table>
        <thead>
        <tr>
            <th>Reservation id</th>
            <th>Employee id</th>
            <th>Customer id</th>
            <th>Date</th>
            <th>Time</th>
            <th>Table id</th>
            <th>Number of Guests</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reservationArray as $tableRes){
            if(!isset($tableRes['room_id'])){
                buildRestaurantReservationDisplay($tableRes, $connection);
            }
        }
        ?>
        </tbody>
    </table>
    <a href="admin.php" > Back to admin </a>

<?php  include "templates/footer.php"; ?>