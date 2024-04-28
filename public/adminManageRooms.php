<?php
include "templates/header.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
include_once "../src/Functions/databasefunctions.php";
require_once '../src/DBconnect.php';

if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$_SESSION['guestRedirect'] = "adminManageRooms.php";
$keys = ['room_id', 'room_type', 'accessibility', 'price'];
$roomArray = buildTableList($connection, "rooms","room_id");

if(isset($_POST['submit_post']))
{
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateRoom.php");
}
if(isset($_POST['delete_post'])){
    $temp_id = $_POST['item_id'];
    deleteData($connection, "rooms","room_id",$temp_id);
    header("refresh:0");
}
?>
    <h2>Manage Rooms</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Room id</th>
            <th scope="col">Room Type</th>
            <th scope="col">Accessibility</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($roomArray as $room){
            printData($room, "room_id");
        }  ?>
        </tbody>
    </table>
    <a href="createRoom.php" class="btn btn-success"> Create a room </a>
    <a href="admin.php" class="btn btn-secondary"> Back to admin </a>
<?php
include_once "templates/footer.php";
