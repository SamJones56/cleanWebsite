<?php
include "../src/Functions/adminManageUsersFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

if ($_SESSION['permissionlvl'] == 0) {
//    header("location:index.php");
}

$_SESSION['guestRedirect'] = "adminManageUsers.php";

?>
    <h2>Employees</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Login id</th>
            <th scope="col">User id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Department id</th>
            <th scope="col">Job</th>
        </tr>
        </thead>
        <tbody>
        <?php buildEmployeeList($connection); ?>
        </tbody>
    </table>

    <h2>Members</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">User id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Passport number</th>
        </tr>
        </thead>
        <tbody>
        <?php buildMemberList($connection); ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary"> Back to admin </a>

<?php include "templates/footer.php"; ?>