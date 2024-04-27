<?php
include "../src/Functions/discountFunctions.php";
include "../src/Functions/databasefunctions.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
require_once '../src/DBconnect.php';
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$editingDisc = getItemToUpdate($connection, "discounts", "discount_id", $_SESSION['tempEdit']);
var_dump($editingDisc);
updateDiscount($connection);
?>
<h2>Update a Discount</h2>
<div id="dataForm">
    <form method="post">
        <label for="discount_id">Discount id</label>
        <input type="text" name="discount_id" id="discount_id" value="<?php echo $editingDisc['discount_id']?>"><br>

        <label for="startDate">Start Date</label>
        <input type="date" name="startDate" id="startDate" value="<?php echo $editingDisc['startDate']?>"><br>

        <label for="endDate">End Date</label>
        <input type="date" name="endDate" id="endDate" value="<?php echo $editingDisc['endDate']?>"><br>

        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" value="<?php echo $editingDisc['amount']?>"><br>

        <label for="description">Amount</label>
        <input type="text" name="description" id="description" value="<?php echo $editingDisc['description']?>"><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="adminManageDiscounts.php">Back to Discounts</a>
</div>