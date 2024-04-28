<?php
include "templates/header.php";

if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
// Include header template.


?>

<title>Admin Page</title>
<?php if($_SESSION['permissionlvl'] > 2){?>
  <div>
    <form action="adminManageRooms.php" method="post">
        <button class="btn btn-light btn-lg btn-block btn btn-outline-success"  type="submit">Manage Rooms</button>
    </form>
</div>
<br>
 <div>
    <form action="adminManageTables.php" method="post">
        <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Manage Tables</button>
    </form>
</div>
<br>
    <div>
        <form action="adminManageDepts.php" method="post">
            <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Manage departments</button>
        </form>
    </div>
    <br>
    <div>
        <form action="adminManageUsers.php" method="post">
            <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Manage users</button>
        </form>
    </div>
    <br>
    <div>
        <form action="createEmployee.php" method="post">
            <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Add Employees</button>
        </form>
    </div>
    <br>
    <div>
        <form action="adminManageDiscounts.php" method="post">
            <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Manage Discounts</button>
        </form>
    </div>
    <br>
<?php } ?>
    <div>
        <form action="adminManageReservations.php" method="post">
            <button class="btn btn-light btn-lg btn-block btn btn-outline-success" type="submit">Manage Bookings</button>
        </form>
    </div>
    <br>

<?php

include "templates/footer.php";
?>