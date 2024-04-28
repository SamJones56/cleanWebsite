<?php

use person\Employee;

function makeNewEmployee()
{
    // Handle form post
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/person/Employee.php';

        // Create a new employee object
        $employee = new Employee();

        // Set user attributes
        $employee->setName(escape($_POST['name']));
        $employee->setAddress(escape($_POST['address']));
        $employee->setPhNo(escape($_POST['ph_no']));
        $employee->setDob(escape($_POST['dob']));

        // Add to user table
        addToTable($connection, $employee->getUserArray(), "user");

        // Get user_id
        $employee->setUserId(getKey($connection, "user", "user_id"));

        // Set login attributes
        $employee->setLoginDetails(escape($_POST['email']), escape($_POST['password']), escape($_POST['permissionlvl']));

        // Add login table
        addToTable($connection, $employee->toLoginArray(), "login");

        // Get login_id
        $employee->setLoginId(getKey($connection, "login", "login_id"));

        // Set employee attributes
        $employee->setDeptId(escape($_POST['dept_id']));
        $employee->setJob(escape($_POST['job']));

        // Add to employee table
        addToTable($connection, $employee->toEmployeeArray(), "employee");
    }
}