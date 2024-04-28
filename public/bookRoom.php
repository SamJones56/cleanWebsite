<?php
include_once "../src/functions/newRoomReservation.php";
include_once "templates/header.php";
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';
//tempRoomReservation($connection, 0);
//
// https://www.w3schools.com/php/php_form_required.asp

$empErr = $custErr = $chk_inErr = $chk_outErr = $num_gErr = "";

if (isset($_POST['submit'])) {
    if (empty($_POST["employee_id"]) || $_POST["employee_id"] < 1 || !is_numeric($_POST['employee_id'])) {
        $empErr = "Employee ID is invalid";
    }
    if (empty($_POST["customer_id"]) || $_POST["customer_id"] < 1 || !is_numeric($_POST['customer_id'])) {
        $custErr = "Customer ID is invalid";
    }
    if (empty($_POST["check_in"]) || (strtotime($_POST['check_in']) > strtotime($_POST['check_out'])) || (strtotime($_POST['check_in']) < strtotime(date('Y-m-d')))) {
        $chk_inErr = "Check in date is invalid";
    }
    if (empty($_POST["check_out"]) || (strtotime($_POST['check_in']) < strtotime($_POST['check_out'])) || (strtotime($_POST['check_out']) < strtotime(date('Y-m-d')))) {
        $chk_outErr = "Check out date is invalid";
    }
    if (empty($_POST["num_guests"]) || $_POST["num_guests"] < 1 || !is_numeric($_POST['num_guests'])) {
        $num_gErr = "Employee ID is invalid";
    } else {
        tempRoomReservation($connection, 0);
    }
}
$keys = array("employee_id", "customer_id", "date", "check_in", "check_out", "payment", "num_guests");

?>
    <h2>Reserve A Room</h2>

    <div id="dataForm" class="form-group">
    <form method="post">

<?php if (!isset($_SESSION['temp_room_reservation'])) {
    if ($_SESSION['isEmployee']) {
        ?>
        <label for="employee_id" >Employee id</label>
        <input type="text" name="employee_id" id="employee_id" class="form-control">
        <span class="error"> <?php echo $empErr; ?></span>
        <br>
        <label for="customer_id">Customer id</label>
        <input type="text" name="customer_id" id="customer_id" required class="form-control">
        <span class="error"> <?php echo $custErr; ?></span>
        <br>
    <?php } ?>

    <?php if ($_SESSION['permissionlvl'] == 1) { ?>
        <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden class="form-control">
        <input type="text" name="customer_id" id="customer_id"
               value="<?php echo getAssociationKey($connection, "member", $_SESSION['login_id'], "login_id", "customer_id") ?>"
               hidden class="form-control">
        <br>
    <?php }
    if ($_SESSION['permissionlvl'] == 0) {
        ?>
        <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden class="form-control">
        <input type="text" name="customer_id" id="customer_id"
               value="<?php echo $_SESSION['customer_id'] ?>" hidden class="form-control">
    <?php } ?>
    <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

    <label for="check_in">check_in</label>
    <input type="date" name="check_in" id="check_in" value="<?php echo date('Y-m-d'); ?>" required class="form-control">
    <span class="error"> <?php echo $chk_inErr; ?></span>

    <br>
    <label for="check_out">check_out</label>
    <input type="date" name="check_out" id="check_out" required class="form-control">
    <span class="error"><?php echo $chk_outErr; ?></span>
    <br>

    <label for="payment">Payment</label>
    <select name="payment" id="payment" required class="form-control">
        <option value="card">Card</option>
        <option value="cash">Cash</option>
    </select> <br>

    <label for="num_guests">Number of Guests</label>
    <input type="number" name="num_guests" id="num_guests" required class="form-control">
    <span class="error"><?php echo $num_gErr; ?></span>
    <br>

<?php } else {
    bookingRestore($keys, $_SESSION['temp_room_reservation']);
        }
    ?>


    <input type="submit" name="submit" value="Reserve a room" class="btn btn-success">
        <a href="stays.php" class="btn btn-secondary">Back to Stays</a>
    </form>
    </div>


    <?php include "templates/footer.php"; ?>