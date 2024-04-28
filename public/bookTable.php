<?php include "templates/header.php";
include "../src/functions/newRestaurantReservationsFunctions.php";
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';

if (isset($_POST['submit'])) {
    tempTableReservation($connection, 1);
}

?>

    <title>Dine</title>
    <form method="post">

        <?php if ($_SESSION['isEmployee']) { ?>
            <label for="employee_id">Employee id</label>
            <input type="text" name="employee_id" id="employee_id" class="form-control">
            <br>
            <label for="customer_id">Customer id</label>
            <input type="text" name="customer_id" id="customer_id" required class="form-control">
            <br>
        <?php } ?>

        <?php if (!$_SESSION['isEmployee']) { ?>
            <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden class="form-control">
            <br>
            <input type="text" name="customer_id" id="customer_id"
                   value="<?php echo $_SESSION['customer_id']['customer_id']; ?>" hidden class="form-control">
            <br>

        <?php } ?>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required class="form-control">
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required class="form-control">
        <br>
        <label for="num_guests">Number of Guests:</label>
        <input type="number" id="num_guests" name="num_guests" required class="form-control">
        <br>
        <label for="special_requests">Special Requests:</label>
        <br>
        <textarea id="special_requests" name="special_requests" rows="4" cols="50" class="form-control"></textarea>
        <br>
        <input type="submit" name="submit" value="Reserve a table" class="btn btn-success">
        <a href="dine.php" class="btn btn-secondary">Back to Dine</a>
    </form>

<?php include "templates/footer.php"; ?>