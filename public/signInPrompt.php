<?php
include "templates/header.php";

// Check if user is logged in

if (isset($_POST['room_type'])) {
    $_SESSION['temp_room_type'] = $_POST['room_type'];
    $_SESSION['guestRedirect'] = "bookRoom.php";
}
if ($_SESSION['Active']) {
    header("location:" . $_SESSION['guestRedirect']);
} else {
    ?>


    <form action="userLogin.php" method="post">
        <button class="btn  btn-lg btn-block btn btn-outline-success" type="submit" name="submit-login"> Sign in
        </button>
    </form>
    <br>
    <form action="createGuest.php" method="post">
        <button class="btn btn-lg btn-block btn btn-success" type="submit" name="submit-guest"> Continue as Guest
        </button>
    </form>

<?php };


