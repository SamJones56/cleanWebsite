<?php
include "../src/Functions/reservationDisplayAndUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

//var_dump($_SESSION);


// Check if room
if($_SESSION['isRoom'])
{
    $res_array = newReservationDisplay($_SESSION['temp_res'], $_SESSION['isRoom'], $connection);
//    var_dump($res_array);
?>

<h2>Edit A Reservation</h2>
<div id="dataForm">
    <form method="post">
        <?php if($_SESSION['isEmployee']){?>
            <label for="employee_id">Employee id</label>
            <input type="text" name="employee_id" id="employee_id" value="<?php echo $res_array['employee_id']?>">
            <label for="customer_id">Customer id</label>
            <input type="text" name="customer_id" id="customer_id" value="<?php echo $res_array['customer_id']?>" required>
        <?php } ?>

        <?php if(!$_SESSION['isEmployee']) { ?>
            <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
            <input type="text" name="customer_id" id="customer_id" value="<?php echo $res_array['customer_id']; ?>" hidden>

        <?php } ?>
        <label for="room_id">room_id</label>
        <input type="text" name="room_id" id="room_id" value="<?php echo $res_array['room_id']?>" required>

        <!--            <label for="date">date</label>-->
        <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

        <label for="check_in">check_in</label>
        <input type="date" name="check_in" id="check_in" value="<?php echo $res_array['check_in']?>" required>

        <label for="check_out">check_out</label>
        <input type="date" name="check_out" id="check_out" value="<?php echo $res_array['check_out']?>" required>
        <label for="payment">Payment</label>

        <select name="payment" id="payment" required>
            <option value="card">Card</option>
            <option value="cash">Cash</option>
        </select> <br>

        <label for="num_guests">num_guests</label>
        <input type="number" name="num_guests" id="num_guests" value="<?php echo $res_array['num_guests']?>" required>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>

<?php }

else
{
    $res_array = newReservationDisplay($_SESSION['temp_res'], $_SESSION['isRoom'], $connection);
//    var_dump($res_array);
 ?>

    <h2>Edit A Reservation</h2>
    <div id="dataForm">
        <form method="post">
            <?php if($_SESSION['isEmployee']){?>
                <label for="employee_id">Employee id</label>
                <input type="text" name="employee_id" id="employee_id" value="<?php echo $res_array['employee_id']?>">

                <label for="customer_id">Customer id</label>
                <input type="text" name="customer_id" id="customer_id" value="<?php echo $res_array['customer_id']?>" required>

                <label for="table_id">Table id</label>
                <input type="text" name="table_id" id="table_id" value="<?php echo $res_array['table_id']?>" required>
            <?php } ?>

            <?php if(!$_SESSION['isEmployee']) { ?>
                <input type="text" name="employee_id" id="employee_id" readonly value="1" hidden>
                <input type="text" name="customer_id" id="customer_id" value="<?php echo $res_array['customer_id']; ?>" hidden>
            <?php } ?>

            <!--            <label for="date">date</label>-->
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" hidden>

            <label for="check_in">Date</label>
            <input type="date" name="date" id="date" value="<?php echo $res_array['date']?>" required>

            <label for="check_out">Time</label>
            <input type="time" name="time" id="time" value="<?php echo $res_array['time']?>" required>

            <label for="no_guests">num_guests</label>
            <input type="number" name="no_guests" id="no_guests" value="<?php echo $res_array['no_guests']?>" required>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>


<?php

}

if(isset($_POST['submit']))
{
    buildReservation($res_array, $_SESSION['isRoom'],$connection);
}

?>
