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

if(isset($_POST['submit_room']))
{
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateRoom.php");
}
?>


    <h2>Manage Rooms</h2>
    <table>
        <thead>
        <tr>
            <th>Room id</th>
            <th>Room Type</th>
            <th>Accessibility</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($roomArray as $room){
            printData($room, "room_id");
        }  ?>
        </tbody>
    </table>



<?php
include_once "templates/footer.php";
