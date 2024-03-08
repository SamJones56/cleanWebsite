<?php
include "templates/header.php";

if($_SESSION['permissionlvl'] < 3 )
{
    header("location:index.php");
}
// Include header template.


?>
<title>Admin Page</title>
  <div>
    <form action="createRoom.php" method="post">
        <button type="submit">Create Room</button>
    </form>
</div>
<br>
 <div>
    <form action="createRestaurantTable.php" method="post">
        <button type="submit">Create Table</button>
    </form>
</div>
<br>
<div>
    <form action="createEmployee.php" method="post">
        <button type="submit">Create Employee</button>
    </form>
</div>
<br>
    <div>
        <form action="createDepartment.php" method="post">
            <button type="submit">Create department</button>
        </form>
    </div>
    <br>
    <div>
        <form action="adminManageUsers.php" method="post">
            <button type="submit">Manage users</button>
        </form>
    </div>
    <br>


<?php

include "templates/footer.php";
?>