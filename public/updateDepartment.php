<?php
include "../src/Functions/departmentFunctions.php";
include "../src/Functions/databasefunctions.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
require_once '../src/DBconnect.php';
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$editingDept = getItemToUpdate($connection, "departments", "dept_id", $_SESSION['tempEdit']);
var_dump($editingDept);
updateDept($connection);
?>
<h2>Update a Department</h2>
<div id="dataForm">
    <form method="post">
        <label for="dept_id">Dept id</label>
        <br>
        <input type="text" name="dept_id" id="dept_id" class="form-control" value="<?php echo $editingDept['dept_id']?>"><br>

        <label for="dept_name">Dept Name</label>
        <br>
        <input type="text" name="dept_name" id="dept_name" class="form-control" value="<?php echo $editingDept['dept_name']?>"><br>

        <label for="address">Address</label>
        <br>
        <input type="text" name="address" id="address" class="form-control" value="<?php echo $editingDept['address']?>"><br>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>