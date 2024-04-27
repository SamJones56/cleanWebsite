<?php
include "../src/Functions/discountfunctions.php";
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
makeDisount();
?>
    <h2>Add a Discount</h2>
    <div id="dataForm">
        <form method="post">
            <label for="startDate">Start Date</label>
            <input type="text" name="startDate" id="startDate">

            <label for="endDate">End Date</label>
            <input type="text" name="endDate" id="endDate">

            <label for="amount">Amount</label>
            <input type="text" name="amount" id="amount">

            <label for="description">Description</label>
            <input type="text" name="description" id="description">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="adminManageDiscounts.php">Back to Discounts</a>

<?php include "templates/footer.php"; ?>