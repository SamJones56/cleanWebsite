<?php
include "../src/Functions/adminManageUsersFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}

$_SESSION['guestRedirect'] = "adminManageUsers.php";

?>
    <h2>Employees</h2>
    <table>
        <thead>
        <tr>
            <th>Login id</th>
            <th>User id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Department id</th>
            <th>Job</th>
        </tr>
        </thead>
        <tbody>
        <?php buildEmployeeList($connection); ?>
        </tbody>
    </table>

    <h2>Members</h2>
    <table>
        <thead>
        <tr>
            <th>User id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Passport number</th>
        </tr>
        </thead>
        <tbody>
        <?php buildMemberList($connection); ?>
        </tbody>
    </table>
    <a href="admin.php" > Back to admin </a>

<?php  include "templates/footer.php"; ?>