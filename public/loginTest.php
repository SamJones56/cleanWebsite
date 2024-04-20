<?php
  ///Test Valdiation for login.
//Report Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
use person\Login;
require_once '../src/functions/userSignInFunctions.php';
//CRUD VALIDATION - LOGIN
//Test Login Creation CREATE
createLogin(); //Comment out for userLogin();

//Test Login Function READ & USE
userLogIn(); //Comment out for CREATE & DELETE

//Test Delete DELETE
//deleteLogin();//Comment out for userLogin();

?>

<title>Sign in</title>
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" >Email</label>
            <input name="Email" type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="Password" class="form-control" placeholder="Password" required>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

        </form>


    <?php echo "Login Credentials to Validate: <br>";
        echo "email: test@test.com <br> ";
        echo "password: PASSWORD <br>";



//function createLogin(){
//require_once '../src/person/Login.php';
//require_once '../src/functions/dataBaseFunctions.php';
//require_once '../src/DBconnect.php';
//
//$login = new Login();
//
//$login->setLoginId("100");
//$login->setPermissionlvl("1");
//$login->setPassword("PASSWORD");
//$login->setEmail("test@test.com");
//
//addToTable($connection, $login->toLoginArray(), "Login");
//    echo '<br>Login Details Added Successfully';
//
//}

function deleteLogin(){
require_once '../src/functions/dataBaseFunctions.php';
require_once '../src/DBconnect.php';

deleteData($connection, "Login", "login_id", 100); //Comment out for USER SIGN IN
    echo '<br>Login Removed Successfully';
}

//function userLoginTest(){
//    require_once '../src/functions/userSignInFunctions.php';
//    require_once '../src/person/Login.php';
//    userLogIn();
//}

?>

