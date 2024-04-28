<?php
include "../src/Functions/newEmployeeFunctions.php";
include "templates/header.php";
if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}
makeNewEmployee();
?>

    <h2>Add a new staff member</h2>
    <div id="dataForm">
        <form method="post">

            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>

            <label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob" class="form-control" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>

            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" class="form-control" required>

            <label for="ph_no">Phone Number</label>
            <input type="text" name="ph_no" id="ph_no" class="form-control" required>

            <label for="password">password</label>
            <input type="password" name="password" id="password" class="form-control" required>

            <label for="dept_id">Department id</label>
            <input type="text" name="dept_id" id="dept_id" class="form-control" required>

            <label for="job">Job</label>
            <input type="text" name="job" id="job" class="form-control" required>

            <label for="permissionlvl">Permission Level</label>
            <input type="text" name="permissionlvl" id="permissionlvl" class="form-control" required>

            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <a href="Admin.php" class="btn btn-secondary">Back to Admin</a>
        </form>
    </div>


<?php include "templates/footer.php"; ?>