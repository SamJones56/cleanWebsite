<?php
include "../src/functions/newRoomReservation.php"; // Make sure this path is correct
include "templates/header.php";
newRoomReservation();
// Report all errors
error_reporting(E_ALL);


?>

    <h2>Reserve A Room</h2>
    <div id="dataForm">
        <form method="post">

        <label for="reservations_id">reservations_id</label>
            <input type="number" name="reservations_id" id="reservations_id">

            <label for="staff_id">staff_id</label>
            <input type="number" name="staff_id" id="staff_id">

            <label for="customer_id">customer_id</label>
            <input type="number" name="customer_id" id="customer_id">

            <label for="room_id">room_id</label>
            <input type="number" name="room_id" id="room_id">

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

            <label for="total_price">total_price</label>
            <input type="number" name="total_price" id="total_price">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>