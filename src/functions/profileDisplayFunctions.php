<?php

function newProfileDisplay($login_id,$isEmployee)
{
    require "../common.php";
    include "dataBaseFunctions.php";
    require_once '../src/DBconnect.php';

    if($isEmployee) {

        // Get the employee_id by searching in the employee table
        $employee_id = getAssociationKey($connection, "employee", $login_id, "login_id" ,  "employee_id");

        // Get the user id by searching in the employee table
        $user_id = getAssociationKey($connection, "employee", $employee_id,  "employee_id","user_id");

        // Search user table for data
        $temp_array = searchDB($connection, "user", "user_id", $user_id);

        // Search employee table for data
        $temp_array = $temp_array + searchDB($connection, "employee", "employee_id", $employee_id);

        // Search login table for data
        $temp_array = $temp_array + searchDB($connection, "login", "login_id", $login_id);

        return $temp_array;
    }
    else {
        // Get the employee_id by searching in the customer table
        $customer_id = getAssociationKey($connection, "member", $login_id, "login_id","customer_id");

        // Get the user id by searching in the customer table
        $user_id = getAssociationKey($connection, "customer", $customer_id,  "customer_id","user_id");

        // Search user table for data
        $temp_array = searchDB($connection, "user", "user_id", $user_id);

        // Search employee table for data
        $temp_array = $temp_array + searchDB($connection, "customer", "customer_id", $customer_id);

        // Search login table for data
        $temp_array = $temp_array + searchDB($connection, "login", "login_id", $login_id);

        return $temp_array;
    }
}