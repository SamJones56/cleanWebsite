<?php include "templates/header.php";
include "../src/functions/newRestaurantReservationsFunctions.php";

newRestaurantReservation();

?>

    <title>Dine</title>

    <form method="post">

        <?php if($_SESSION['isEmployee']){?>
            <label for="employee_id">Employee id</label>
            <input type="text" name="employee_id" id="employee_id" >
            <br>
            <label for="customer_id">Customer id</label>
            <input type="text" name="customer_id" id="customer_id" required>
            <br>
        <?php } ?>

        <?php if(!$_SESSION['isEmployee']) { ?>
            <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
            <br>
            <input type="text" name="customer_id" id="customer_id" value="<?php echo $_SESSION['customer_id']['customer_id']; ?>" hidden>
            <br>

        <?php } ?>

<!--        <label for="table_id">table_id</label>-->
<!--        <input type="text" id="table_id" name="table_id" required>-->

<!--        <label for="email">Email:</label>-->
<!--        <input type="email" id="email" name="email" required>-->
<!---->
<!--        <label for="phone">Phone:</label>-->
<!--        <input type="tel" id="phone" name="phone" required>-->

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>
        <br>
        <label for="guests">Number of Guests:</label>
        <input type="number" id="guests" name="guests" required>
        <br>
        <label for="special_requests">Special Requests:</label>
        <br>
        <textarea id="special_requests" name="special_requests" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>