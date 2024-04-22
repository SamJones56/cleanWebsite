<?php
include_once "../src/functions/newRoomReservation.php";
include_once "templates/header.php";
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';
//tempRoomReservation($connection, 0);
//
// https://www.w3schools.com/php/php_form_required.asp

$empErr = $custErr = $chk_inErr = $chk_outErr = $num_gErr = "";

if (isset($_POST['submit']))
{
    if(empty($_POST["employee_id"]) || $_POST["employee_id"] < 1 || !is_numeric($_POST['employee_id'])){
        $empErr = "Employee ID is invalid";
    }
    if(empty($_POST["customer_id"]) || $_POST["customer_id"] < 1 || !is_numeric($_POST['customer_id'])){
        $custErr = "Customer ID is invalid";
    }
    if(empty($_POST["check_in"]) || (strtotime($_POST['check_in']) > strtotime($_POST['check_out'])) || (strtotime($_POST['check_in']) < strtotime(date('Y-m-d')))){
        $chk_inErr = "Check in date is invalid";
    }
    if(empty($_POST["check_out"]) || (strtotime($_POST['check_in']) < strtotime($_POST['check_out'])) || (strtotime($_POST['check_out']) < strtotime(date('Y-m-d')))){
        $chk_outErr = "Check out date is invalid";
    }
    if(empty($_POST["num_guests"]) || $_POST["num_guests"] < 1 || !is_numeric($_POST['num_guests'])){
        $num_gErr = "Employee ID is invalid";
    }
    else {
        tempRoomReservation($connection, 0);
    }
}


?>

    <h2>Reserve A Room</h2>
    <div id="dataForm">
        <form method="post">

            <?php if($_SESSION['isEmployee']){?>
                <label for="employee_id">Employee id</label>
                <input type="text" name="employee_id" id="employee_id" >
                <span class="error">* <?php echo $empErr;?></span>
                <br>

                <label for="customer_id">Customer id</label>
                <input type="text" name="customer_id" id="customer_id" required>
                <span class="error">* <?php echo $custErr;?></span>
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
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

            <label for="check_in" >check_in</label>
            <input type="date" name="check_in" id="check_in" value="<?php echo date('Y-m-d');?>" required>
            <span class="error">* <?php echo $chk_inErr;?></span>

            <br>
            <label for="check_out">check_out</label>
            <input type="date" name="check_out" id="check_out" required>
            <span class="error">* <?php echo $chk_outErr;?></span>
            <br>

            <label for="room_type">Payment</label>
            <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br>

            <label for="num_guests">Number of Guests</label>
            <input type="number" name="num_guests" id="num_guests" required>
            <span class="error">* <?php echo $num_gErr;?></span>
            <br>
<!--            <label for="total_price">--><?php //getAssociationKey($connection, "rooms", "", "room_id", "price")?><!--</label>-->
<!--            <input type="number" name="total_price" id="total_price">-->

            <input type="submit" name="submit" "value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>