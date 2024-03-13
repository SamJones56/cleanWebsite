<?php
include "../src/Functions/adminManageReservationFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

//$user_array = buildUserList($connection);

//buildUserList($connection);

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
        </tr>
        </thead>
        <tbody>
        <?php buildRoomReservationGeneralList($connection); ?>
        </tbody>
    </table>

    <h2>Restaurant Bookings</h2>
    <table>
        <thead>
        <tr>
            <th>Reservation id</th>
            <th>Employee id</th>
            <th>Date</th>
            <th>Time</th>
            <th>Table id</th>
            <th>Number of Guests</th>
        </tr>
        </thead>
        <tbody>
<!--        --><?php //buildMemberList($connection); ?>
        </tbody>
    </table>


<?php  include "templates/footer.php"; ?>