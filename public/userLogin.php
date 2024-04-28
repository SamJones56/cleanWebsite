<?php include "templates/header.php";
include "../src/Functions/userSignInFunctions.php";
require_once '../src/DBconnect.php';

if(isset($_POST['Submit'])) {
    userLogIn($connection, 0);
}
?>
    <body>
    <div class="container">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="email" >Email</label>
            <input name="Email" type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="Password">Password</label>
            <input name="Password" type="password" id="Password" class="form-control" placeholder="Password" required>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
            <!--        https://www.w3schools.com/howto/howto_js_redirect_webpage.asp -->
            <button name="Reg" value="Reg" class="button" type="button"><a href="memberSignUp.php">Register</a></button>
        </form>
<?php include "templates/footer.php"; ?>