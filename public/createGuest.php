<?php
include "../src/Functions/newGuestFunctions.php";
include "templates/header.php";
makeNewGuest();
?>


    <h2>Enter Guest Details</h2>
    <div id="dataForm">
        <form method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">

            <label for="dob">Date of Birth</label>
            <input type="text" name="dob" id="dob">

            <label for="address">Address</label>
            <input type="text" name="address" id="address">

            <label for="ph_no">Phone Number</label>
            <input type="text" name="ph_no" id="ph_no">

            <label for="passport_no">Passport Number</label>
            <input type="text" name="passport_no" id="passport_no">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
<!--    <a href="bookRoom.php">Back to stays</a>-->

<?php include "templates/footer.php"; ?>