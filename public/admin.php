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
        <button type="submit">Manage Rooms</button>
    </form>
</div>
<br>
 <div>
    <form action="adminManageTables.php" method="post">
        <button type="submit">Manage Tables</button>
    </form>
</div>
<br>
    <div>
        <form action="adminManageDepts.php" method="post">
            <button type="submit">Manage departments</button>
        </form>
    </div>
    <br>
    <div>
        <form action="adminManageUsers.php" method="post">
            <button type="submit">Manage users</button>
        </form>
    </div>
    <br>
    <div>
        <form action="createEmployee.php" method="post">
            <button type="submit">Add Employees</button>
        </form>
    </div>
    <br>
<?php } ?>
    <div>
        <form action="adminManageReservations.php" method="post">
            <button type="submit">Manage Bookings</button>
        </form>
    </div>
    <br>

<?php

include "templates/footer.php";
?>