<?php
include "templates/header.php";

if($_SESSION['Active'])
{
    header("location:bookRoom.php");
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
