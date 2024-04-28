<?php
include "../src/Functions/roomFunctions.php";
include "../src/Functions/databasefunctions.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
require_once '../src/DBconnect.php';
include "templates/header.php";
if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}
$editingRoom = getItemToUpdate($connection, "rooms", "room_id", $_SESSION['tempEdit']);
//var_dump($editingRoom);
updateRoom($connection);
?>
<h2>Update a Room</h2>
<div id="dataForm">
    <form method="post">
        <label for="room_id">Room id</label>
        <input type="text" name="room_id" id="room_id" value="<?php echo $editingRoom['room_id'] ?>"
               class="form-control" required>

        <label for="room_type">Room Type</label>
        <select
                name="room_type" id="room_type" value="<?php echo $editingRoom['room_type'] ?>" class="form-control"
                required>
            <option value="suite">Suite</option>
            <option value="double">Double</option>
            <option value="twin">Twin</option>
            <option value="family">Family</option>
        </select>


        <label for="accessibility">Accessibility</label>
        <select
                name="accessibility" id="accessibility" value="<?php echo $editingRoom['accessibility'] ?>"
                class="form-control" required>
            <option value="wheelchair">Wheelchair Accessible</option>
            <option value="non_accessible">Non Accessible</option>
        </select>

        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="<?php echo $editingRoom['price'] ?>" class="form-control"
               required>
        <br>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        <a href="adminManageRooms.php" class="btn btn-secondary">Back to Rooms</a>
    </form>

</div>