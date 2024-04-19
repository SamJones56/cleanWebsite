<?php
  ///Test Valdiation for login.
//Report Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
use person\Login;

function createLogin(){
    require_once '../src/person/Login.php';
    require_once '../src/functions/dataBaseFunctions.php';
    require_once '../src/DBconnect.php';

    $login = new Login();

    $login->setLoginId("100001");
    $login->setPermissionlvl("1");
    $login->setPassword("PASSWORD");
    $login->setEmail("test@test.com");

addToTable($connection, $login->toLoginArray(), "Login");

}
//createLogin();
require_once '../src/functions/userSignInFunctions.php';
userLogIn(); //
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Sign in</title>
    </head>
    <body>
    <div class="container">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" >Email</label>
            <input name="Email" type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="Password" class="form-control" placeholder="Password" required>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
            <button name="Reg" value="Reg" class="button" type="button" onclick="redirectToRegister()">Register</button>
        </form>


    <?php    echo "Login Credentials to Validate: <br>";
        echo "email: test@test.com <br> ";
        echo "password: PASSWORD <br>";

?>







