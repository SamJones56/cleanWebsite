<?php
include "../src/functions/newRoomReservation.php";
include "templates/header.php";
newRoomReservation();
// Report all errors
error_reporting(E_ALL);


?>

    <h2>Reserve A Room</h2>
    <div id="dataForm">
        <form method="post">

<!--        <label for="reservations_id">reservations_id</label>-->
<!--            <input type="text" name="reservations_id" id="reservations_id">-->

            <label for="employee_id">employee_id</label>
            <input type="text" name="employee_id" id="employee_id">

            <label for="customer_id">customer_id</label>
            <input type="text" name="customer_id" id="customer_id">

            <label for="room_id">room_id</label>
            <input type="text" name="room_id" id="room_id">

            <label for="date">date</label>
            <input type="date" name="date" id="date">

            <label for="check_in">check_in</label>
            <input type="date" name="check_in" id="check_in">

            <label for="check_out">check_out</label>
            <input type="date" name="check_out" id="check_out">
            <label for="room_type">Room Type</label>

            <select name="payment" id="payment">
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br>

            <label for="num_guests">num_guests</label>
            <input type="number" name="num_guests" id="num_guests">

<!--            <label for="total_price">--><?php //getAssociationKey($connection, "rooms", "", "room_id", "price")?><!--</label>-->
<!--            <input type="number" name="total_price" id="total_price">-->

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>