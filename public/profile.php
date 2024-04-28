<?php
include "../src/Functions/adminManageReservationFunctions.php";
include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
include_once "../src/Functions/reservationDisplayAndUpdateFunctions.php";
//include_once "../src/Functions/profileUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

if ($_SESSION['permissionlvl'] == 0)
{
    header("location:index.php");
}
$user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee'],$connection);

$_SESSION['temp_login'] = $_SESSION['login_id'];

$_SESSION['guestRedirect'] = "profile.php";
?>

<h2>User Data</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th>User id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <?php if($_SESSION['isEmployee']){ ?>
            <th>Department id</th>
            <th>job</th>
        <?php } else{ ?>
            <th>Passport number</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $user_array["user_id"]; ?></td>
            <td><?php echo $user_array["name"]; ?></td>
            <td><?php echo $user_array["address"]; ?></td>
            <td><?php echo $user_array["ph_no"]; ?></td>
            <td><?php echo $user_array["email"]; ?></td>
            <td><?php echo $user_array["dob"]; ?></td>
            <?php if($_SESSION['isEmployee']){ ?>
                <td><?php echo $user_array["dept_id"]; ?></td>
                <td><?php echo $user_array["job"]; ?></td>
            <?php }else{?>
            <td><?php echo $user_array["passport_no"]; ?></td>
            <?php }?>
            <td><a href="updateUser.php" class="btn btn-warning"> edit </a> </td>

<!--            ?user_id=--><?php //echo $user_array["user_id"];
//                ?><!--">Edit</a></td>-->
        </tr>
    </tbody>
</table>
<h2>Room Bookings</h2>
<table  class="table table-striped" >
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
    <?php

            if ($_SESSION['isEmployee']) {
                buildRoomReservationUserList($connection, $user_array['employee_id'], $_SESSION['isEmployee']);
            } else {
                buildRoomReservationUserList($connection, $user_array['customer_id'], $_SESSION['isEmployee']);
            }

        ?>
    </tbody>
</table>

<h2>Restaurant Bookings</h2>
<table  class="table table-striped">
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


    if ($_SESSION['isEmployee']) {
//        buildRoomReservationUserList($connection, $user_array['employee_id'], $_SESSION['isEmployee']);
        buildRestaurantReservationList($connection, $user_array['employee_id'], $_SESSION['isEmployee']);
    } else {
//        buildRoomReservationUserList($connection, $user_array['customer_id'], $_SESSION['isEmployee']);
        buildRestaurantReservationList($connection, $user_array['customer_id'], $_SESSION['isEmployee']);
    }


//    buildRestaurantReservationList($connection);
    ?>
    </tbody>
</table>
