<?php

include "templates/header.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
include_once "../src/Functions/databasefunctions.php";
require_once '../src/DBconnect.php';


if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$_SESSION['guestRedirect'] = "adminManageDepts.php";
$keys = ['dept_id', 'dept_name', 'address'];
$deptArray = buildTableList($connection, "departments","dept_id");

if(isset($_POST['submit_post']))
{
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateDepartment.php");
}
if(isset($_POST['delete_post'])){
    $temp_id = $_POST['item_id'];
    deleteData($connection, "departments","dept_id",$temp_id);
    header("refresh:0");
}
?>
    <h2>Manage Departments</h2>
    <button><a href="createDepartment.php" > Create a Department </a> </button>
    <table>
        <thead>
        <tr>
            <th>Dept id</th>
            <th>Dept Name</th>
            <th>Address</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($deptArray as $dept){
            printData($dept, "dept_id");
        }  ?>
        </tbody>
    </table>
    <a href="admin.php" > Back to admin </a>
<?php
include_once "templates/footer.php";
