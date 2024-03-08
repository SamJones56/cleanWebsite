<?php
include "../src/Functions/profileDisplayAndUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';


$user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee'], $connection);
buildProfileDisplay($user_array, $_SESSION['isEmployee']);

if(isset($_POST['submit']))
{
    buildUser($user_array, $_SESSION['isEmployee'],$connection);
}

