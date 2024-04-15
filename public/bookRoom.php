<?php
include "../src/functions/newRoomReservation.php";
include "templates/header.php";
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';
tempRoomReservation($connection);
// Report all errors
//error_reporting(E_ALL);

//var_dump("Session: ");
//var_dump($_SESSION);

?>

    <h2>Reserve A Room</h2>
    <div id="dataForm">
        <form method="post">

            <?php if($_SESSION['isEmployee']){?>
                <label for="employee_id">Employee id</label>
                <input type="text" name="employee_id" id="employee_id" >
                <br>

                <label for="customer_id">Customer id</label>
                <input type="text" name="customer_id" id="customer_id" required>
                <br>
           <?php } ?>

            <?php if($_SESSION['permissionlvl'] == 1) { ?>
                <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
                <input type="text" name="customer_id" id="customer_id" value="<?php echo getAssociationKey($connection, "member", $_SESSION['login_id'], "login_id", "customer_id") ?>" hidden>
                <br>
            <?php }
                if($_SESSION['permissionlvl'] == 0){?>
                    <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
                    <input type="text" name="customer_id" id="customer_id" value="<?php echo $_SESSION['customer_id']?>" hidden>
                <?php }?>
<!--            <label for="room_id">room_id</label>-->
<!--            <input type="text" name="room_id" id="room_id" required>-->

<!--            <label for="date">date</label>-->
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

            <label for="check_in">check_in</label>
            <input type="date" name="check_in" id="check_in" required>
            <br>
            <label for="check_out">check_out</label>
            <input type="date" name="check_out" id="check_out" required>
            <br>
            <label for="room_type">Payment</label>

            <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br>

            <label for="num_guests">Number of Guests</label>
            <input type="number" name="num_guests" id="num_guests" required>
            <br>
<!--            <label for="total_price">--><?php //getAssociationKey($connection, "rooms", "", "room_id", "price")?><!--</label>-->
<!--            <input type="number" name="total_price" id="total_price">-->

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>