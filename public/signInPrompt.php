<?php
include "templates/header.php";
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
