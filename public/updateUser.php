<?php
include "../src/Functions/profileDisplayAndUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

// Check if user is editing their own profile
if($_SESSION['login_id'] == $_SESSION['temp_login']) {
    $_SESSION['tempEmployee'] = true;
    $user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee'], $connection);
    buildProfileDisplay($user_array, $_SESSION['isEmployee']);
}
// Check if user is editing anothers profile, using their templogin id to build table
else
{
    $_SESSION['tempEmployee'] = false;
    $user_array = newProfileDisplay($_SESSION['temp_login'], $_SESSION['tempEmployee'], $connection);
    buildProfileDisplay($user_array, $_SESSION['tempEmployee']);
}

if(isset($_POST['submit']))
{
    buildUser($user_array, $_SESSION['isEmployee'],$connection);
}

