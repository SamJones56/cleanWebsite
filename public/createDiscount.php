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
            <input type="date" name="startDate" id="startDate" class="form-control" required>
            <br>
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control" required>
            <br>
            <label for="amount">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control" required>
            <br>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
            <br>
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <a href="adminManageDiscounts.php" class="btn btn-secondary">Back to Discounts</a>
        </form>
    </div>


<?php include "templates/footer.php"; ?>