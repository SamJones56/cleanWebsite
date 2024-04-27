<?php
include "../src/Functions/departmentFunctions.php";
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
makeNewDepartment();
?>

    <h2>Add a Department</h2>
    <div id="dataForm">
        <form method="post">
            <label for="dept_name">Department Name</label>
            <input type="text" name="dept_name" id="dept_name">

            <label for="address">Department address</label>
            <input type="text" name="address" id="address">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="adminManageDepts.php">Back to departments</a>

<?php include "templates/footer.php"; ?>