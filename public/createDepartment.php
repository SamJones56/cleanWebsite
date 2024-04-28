<?php
include "../src/Functions/departmentFunctions.php";
include "templates/header.php";
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
makeNewDepartment();
?>


    <div id="dataForm" class="form-group">
        <h2>Add a Department</h2>
        <form method="post">
            <label for="dept_name">Department Name</label>
            <input type="text" name="dept_name" id="dept_name" class="form-control" required>
            <br>
            <label for="address">Department address</label>
            <input type="text" name="address" id="address" class="form-control" required>
            <br>
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <a href="adminManageDepts.php" class="btn btn-secondary">Back to departments</a>
        </form>
    </div>


<?php include "templates/footer.php"; ?>