<?php
include "templates/header.php";

// Check if user is logged in

if (isset($_POST['room_type'])) {
    $_SESSION['temp_room_type'] = $_POST['room_type'];
    $_SESSION['guestRedirect'] = "bookRoom.php";
}
if($_SESSION['Active'])
{
    header("location:" . $_SESSION['guestRedirect']);
}

else{
?>

<h1>Sign in</h1>
<form action="userLogin.php" method="post">
    <input type="submit" name="submit-login">
</form>
<br>
<h1>Continue as Guest</h1>
<form action="createGuest.php" method="post">
    <input type="submit" name="submit-login">
</form>

<?php };


