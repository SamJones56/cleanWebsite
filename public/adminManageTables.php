<?php
include "templates/header.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
include_once "../src/Functions/databasefunctions.php";
require_once '../src/DBconnect.php';

if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}
$_SESSION['guestRedirect'] = "adminManageTables.php";
$keys = ['table_id', 'capacity'];
$deptArray = buildTableList($connection, "restauranttables", "table_id");

if (isset($_POST['submit_post'])) {
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateTable.php");
}
if (isset($_POST['delete_post'])) {
    $temp_id = $_POST['item_id'];
    deleteData($connection, "restauranttables", "table_id", $temp_id);
    header("refresh:0");
}
?>
    <h2>Manage Tables</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Table id</th>
            <th scope="col">Capacity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($deptArray as $dept) {
            printData($dept, "table_id");
        } ?>
        </tbody>
    </table>
    <a href="createRestaurantTable.php" class="btn btn-success"> Create a Table </a>
    <a href="admin.php" class="btn btn-secondary"> Back to admin </a>
<?php
include_once "templates/footer.php";
