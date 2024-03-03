<?php
include "../src/Functions/newDepartmentFunctions.php";
include "templates/header.php";
makeNewDepartment();
?>

    <h2>Add a table</h2>
    <div id="dataForm">
        <form method="post">
            <label for="dept_name">Department Name</label>
            <input type="text" name="dept_name" id="dept_name">

            <label for="address">Department address</label>
            <input type="text" name="address" id="address">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>