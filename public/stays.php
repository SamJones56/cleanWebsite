<?php
include "templates/header.php";
?>

<title>Stays</title>
<div class ="grid-container">
    <div class="Suite">
        <img src="../images/suite.webp">
        <h4>Suite</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="signInPrompt.php" method="post">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>
    <div class="Double">
        <img src="../images/double.jpg">
        <h4>Double</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="bookRoom.php" method="post">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>
    <div class="Twin">
        <img src="../images/twin.webp">
        <h4>Twin</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="bookRoom.php" method="post">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>

    <div class="Family">
        <img src="../images/family.jpg">
        <h4>Family</h4>
        <p>ROOM DESCRIPTION HERE</p>
        <form action="bookRoom.php" method="post">
            <button type="submit">Book Now</button>
        </form>
    </div>

        <div id="dataForm">
            <form method="post">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

        <?php include "templates/footer.php"; ?>
