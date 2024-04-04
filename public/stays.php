<?php
include "templates/header.php";
?>

<title>Stays</title>
<div class ="grid-container">
    <div class="Suite">
        <img src="../images/suite.webp" width="500">
        <h4>Suite</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="signInPrompt.php" method="post">
            <input type="hidden" name="room_type" value="suite">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>
    <div class="Double">
        <img src="../images/double.jpg" width="500">
        <h4>Double</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="signInPrompt.php" method="post">
            <input type="hidden" name="room_type" value="double">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>
    <div class="Twin">
        <img src="../images/twin.webp" width="500">
        <h4>Twin</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="signInPrompt.php" method="post">
            <input type="hidden" name="room_type" value="twin">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>

    <div class="Family">
        <img src="../images/family.jpg" width="500">
        <h4>Family</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="signInPrompt.php" method="post">
            <input type="hidden" name="room_type" value="family">
            <button type="submit">Book Now</button>
        </form>
    </div>

    <?php include "templates/footer.php"; ?>
