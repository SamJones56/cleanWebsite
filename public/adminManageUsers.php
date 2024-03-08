<?php
include "../src/Functions/adminManageUsersFunctions.php";
include "templates/header.php";
require_once '../src/DBconnect.php';

//$user_array = buildUserList($connection);

?>
<h2>Employees</h2>
<table>
    <thead>
    <tr>
        <th>User id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <th>Department id</th>
        <th>job</th>
    </tr>
    </thead>
    <tbody>
    <?php buildUserList($connection); ?>

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
        <?php buildUserList($connection); ?>

        </tbody>
    </table>

<?php  include "templates/footer.php"; ?>