<?php
// Include header template.
include "templates/header.php";

?>
<title>Admin Page</title>
  <div>
    <form action="createRoom.php" method="post">
        <button type="submit">Create Room</button>
    </form>
</div>
<br>
 <div>
    <form action="createDiningTable.php" method="post">
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


<?php

include "templates/footer.php";
?>