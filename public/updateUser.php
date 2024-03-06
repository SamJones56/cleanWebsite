<?php
include "../src/Functions/profileDisplayFunctions.php";
include "../src/Functions/profileUpdateFunctions.php";
include "../src/Functions/newMemberFunctions.php";
include "../src/Functions/newEmployeeFunctions.php";
include "templates/header.php";

$user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee']);

buildTable($user_array, $_SESSION['isEmployee']);

?>