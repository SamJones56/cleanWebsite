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
var_dump($editingTable);
updateRestTable($connection);
?>
<h2>Update a Department</h2>
<div id="dataForm">
    <form method="post">
        <label for="table_id">Dept id</label>
        <input type="text" name="table_id" id="table_id" value="<?php echo $editingTable['table_id']?>"><br>

        <label for="capacity">Dept Name</label>
        <input type="text" name="capacity" id="capacity" value="<?php echo $editingTable['capacity']?>"><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>