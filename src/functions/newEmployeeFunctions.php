<?php
use person\Employee;

function makeNewEmployee()
{
    if (isset($_POST['submit'])) {
        require_once '../src/person/Employee.php';


        $employee = new Employee();

        // Set user attributes
        $employee->setName(escape($_POST['name']));
        $employee->setAddress(escape($_POST['address']));
        $employee->setPhNo(escape($_POST['ph_no']));
        $employee->setDob(escape($_POST['dob']));

        // Add to user table
        addToTable($connection, $employee->toUserArray(), "user");

        // Get user_id
        $employee->setUserId(getKey($connection, "user", "user_id"));

        // Set login attributes
        $employee->setLoginDetails(($_POST['email']), ($_POST['password']));

        // Add login table
        addToTable($connection, $employee->toLoginArray(), "login");

        // Get login_id
        $employee->setLoginId(getKey($connection, "login", "login_id"));

        // Set employee attributes
        $employee->setDeptId(escape($_POST['dept_id']));
        $employee->setJob(escape($_POST['job']));
        $employee->setPermissionlvl(escape($_POST['permissionlvl']));

        // Add to employee table
        addToTable($connection, $employee->toEmployeeArray(), "employee");

    }
}