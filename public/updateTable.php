<?php
include "../src/Functions/restaurantTableFunctions.php";
include "../src/Functions/databasefunctions.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
require_once '../src/DBconnect.php';
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$editingTable = getItemToUpdate($connection, "restauranttables", "table_id", $_SESSION['tempEdit']);

updateRestTable($connection);
?>
<h2>Update a Table</h2>
<div id="dataForm">
    <form method="post">
        <label for="table_id">Table id</label>
        <input type="text" name="table_id" id="table_id" value="<?php echo $editingTable['table_id']?>" class="form-control">

        <label for="capacity">Capacity</label>
        <input type="text" name="capacity" id="capacity" value="<?php echo $editingTable['capacity']?>" class="form-control">
        <br>
        <input type="submit" name="submit" value="Submit"  class="btn btn-success">
        <a href="adminManageTables.php" class="btn btn-secondary">Back to Tables</a>
    </form>
</div>