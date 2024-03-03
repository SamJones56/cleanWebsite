<?php
include "../src/Functions/newEmployeeFunctions.php";
include "templates/header.php";
makeNewEmployee();
?>

    <h2>Add a new staff member</h2>
    <div id="dataForm">
        <form method="post">

            <label for="name">Name</label>
            <input type="text" name="name" id="name">

            <label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob">

            <label for="address">Address</label>
            <input type="text" name="address" id="address">

            <label for="email">Email Address</label>
            <input type="text" name="email" id="email">

            <label for="ph_no">Phone Number</label>
            <input type="text" name="ph_no" id="ph_no">

            <label for="password">password</label>
            <input type="text" name="password" id="password">

            <label for="dept_id">Department id</label>
            <input type="text" name="dept_id" id="dept_id">

            <label for="job">Job</label>
            <input type="text" name="job" id="job">

            <label for="permissionlvl">Permission Level</label>
            <input type="text" name="permissionlvl" id="permissionlvl">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>