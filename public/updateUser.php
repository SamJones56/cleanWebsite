<?php
include "../src/Functions/profileDisplayAndUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';
if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}

// Check if user is editing their own profile
if($_SESSION['login_id'] == $_SESSION['temp_login']) {
    $user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee'], $connection);
    buildProfileDisplay($user_array, $_SESSION['isEmployee']);
    $_SESSION['tempEmployee'] = false;
}
// Check if its editing another employee
else if($_SESSION['tempEmployee']){
    $user_array = newProfileDisplay($_SESSION['temp_login'], $_SESSION['tempEmployee'], $connection);
    echo '<br>';
    var_dump($user_array);
    buildProfileDisplay($user_array, $_SESSION['tempEmployee']);
    $_SESSION['tempEmployee'] = true;
}


// Check if user is editing anothers profile, using their templogin id to build table
else
{
    $user_array = newProfileDisplay($_SESSION['temp_login'], $_SESSION['tempEmployee'], $connection);
    buildProfileDisplay($user_array, $_SESSION['tempEmployee']);
    $_SESSION['tempEmployee'] = false;
}

if(isset($_POST['submit']))
{
    buildUser($user_array, $_SESSION['tempEmployee'],$connection);
    header("location:" . $_SESSION['guestRedirect']);
}

