<?php include "templates/header.php";
include "../src/Functions/userSignInFunctions.php";
userLogIn();
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
            <!--        https://www.w3schools.com/howto/howto_js_redirect_webpage.asp -->
            <button name="Reg" value="Reg" class="button" type="button" onclick="redirectToRegister()">Register</button>
        </form>
<?php include "templates/footer.php"; ?>