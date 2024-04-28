<?php
include "../src/Functions/newGuestFunctions.php";
include "templates/header.php";
makeNewGuest();
?>


    <h2>Enter Guest Details</h2>
    <div id="dataForm">
        <form method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>

            <label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob" class="form-control" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>

            <label for="ph_no">Phone Number</label>
            <input type="text" name="ph_no" id="ph_no" class="form-control" required>

            <label for="passport_no">Passport Number</label>
            <input type="text" name="passport_no" id="passport_no" class="form-control" required>

            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <a href="index.php" class="btn btn-secondary">Back to home</a>
        </form>
    </div>
<?php include "templates/footer.php"; ?>