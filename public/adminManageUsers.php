<?php
include "../src/Functions/adminManageUsersFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

//$user_array = buildUserList($connection);

//buildUserList($connection);




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


<?php  include "templates/footer.php"; ?>