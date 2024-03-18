<?php
include "../src/functions/newRoomReservation.php";
include "templates/header.php";
newRoomReservation();
// Report all errors
error_reporting(E_ALL);

var_dump("Session: ");
var_dump($_SESSION);

?>

    <h2>Reserve A Room</h2>
    <div id="dataForm">
        <form method="post">

            <?php if($_SESSION['isEmployee']){?>
                <label for="employee_id">Employee id</label>
            <input type="text" name="employee_id" id="employee_id" >

                <label for="customer_id">Customer id</label>
                <input type="text" name="customer_id" id="customer_id" required>
           <?php } ?>

            <?php if(!$_SESSION['isEmployee']) { ?>
                <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
                <input type="text" name="customer_id" id="customer_id" value="<?php echo $_SESSION['customer_id']; ?>" hidden>

                <?php } ?>
            <label for="room_id">room_id</label>
            <input type="text" name="room_id" id="room_id" required>

<!--            <label for="date">date</label>-->
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

            <label for="check_in">check_in</label>
            <input type="date" name="check_in" id="check_in" required>

            <label for="check_out">check_out</label>
            <input type="date" name="check_out" id="check_out" required>
            <label for="room_type">Payment</label>

            <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br>

            <label for="num_guests">num_guests</label>
            <input type="number" name="num_guests" id="num_guests" required>

<!--            <label for="total_price">--><?php //getAssociationKey($connection, "rooms", "", "room_id", "price")?><!--</label>-->
<!--            <input type="number" name="total_price" id="total_price">-->

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>