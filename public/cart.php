<?php
include "templates/header.php";
//var_dump($_SESSION['temp_room_reservation']);

?>

<h2> Booking Details </h2>
<table>
    <thead>
        <tr>
            <th>Room Type</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Payment Type</th>
            <th>Room Cost</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $_SESSION['temp_room_type']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['check_in']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['check_out']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['payment']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['roomPrice']?></td>
        </tr>
    </tbody>
</table>

<br>

<br>

<h2> Room Additions</h2>