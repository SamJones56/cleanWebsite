<?php

use hotel\Department;
function makeNewDepartment()
{
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/hotel/Department.php';

        // Create new department object
        $dept = new Department();

        // Set department attributes
        $dept->setDeptName(escape($_POST['dept_name']));
        $dept->setAddress(escape($_POST['address']));

        // Add to department table
        addToTable($connection, $dept->toDeptArray(), "departments");
        // Set the id
        $dept->setDeptId(getKey($connection, "departments", "dept_id"));

        header("location:adminManageDepts.php");
    }
}

function updateDept($connection)
{
    if (isset($_POST['submit'])) {
        require "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once '../src/hotel/department.php';

        $dept = new Department();

        $dept->setDeptId(escape($_POST['dept_id']));
        $dept->setDeptName(escape($_POST['dept_name']));
        $dept->setAddress(escape($_POST['address']));
        updateTable($connection, $dept->toDeptArray(), "departments", "dept_id", $dept->getdeptId());
        header("location:" . $_SESSION['guestRedirect']);
    }
}