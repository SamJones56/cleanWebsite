<?php
include "../src/Functions/discountFunctions.php";
include "../src/Functions/databasefunctions.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
require_once '../src/DBconnect.php';
include "templates/header.php";
if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}
$editingDisc = getItemToUpdate($connection, "discounts", "discount_id", $_SESSION['tempEdit']);
updateDiscount($connection);
?>
<div class="container">
    <h2>Update a Discount</h2>
    <div id="dataForm">
        <form method="post">
            <label for="discount_id">Discount id</label>
            <input type="text" name="discount_id" id="discount_id" class="form-control"
                   value="<?php echo $editingDisc['discount_id'] ?>">

            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control"
                   value="<?php echo $editingDisc['startDate'] ?>">

            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control"
                   value="<?php echo $editingDisc['endDate'] ?>">

            <label for="amount">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control"
                   value="<?php echo $editingDisc['amount'] ?>">

            <label for="description">Amount</label>
            <input type="text" name="description" id="description" class="form-control"
                   value="<?php echo $editingDisc['description'] ?>">
            <br>
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <a href="adminManageDiscounts.php" class="btn btn-secondary">Back to Discounts</a>
        </form>

    </div>
</div>