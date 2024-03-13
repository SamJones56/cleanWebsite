<?php
include "../src/Functions/reservationDisplayAndUpdateFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

// Check if room
if($_SESSION['isRoom'])
{
    $res_array = newReservationDisplay($_SESSION['temp_res'], $_SESSION['isRoom'], $connection);
    var_dump($res_array);

//    buildROom


}