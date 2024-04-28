<?php
include "../src/Functions/restaurantTableFunctions.php";
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}

// Call Function to
makeNewRestaurantTable();
?>

<title>Add Objects</title>

<h2>Add a Table</h2>

<div id="dataForm">
    <form method="post">
        <label for="table_id">Table No</label>
        <input type="text" name="table_id" id="table_id" class="form-control" required><br>

        <label for="capacity">Capacity</label>
        <input type="text" name="capacity" id="capacity" class="form-control" required><br>

        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        <a href="adminManageTables.php" class="btn btn-secondary">Back to Tables</a>
    </form>
</div>


<?php
// Include footer template.
include "templates/footer.php";
?>

