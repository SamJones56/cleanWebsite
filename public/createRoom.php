<?php
include "../src/Functions/newRoomFunctions.php";
include "templates/header.php";
makeNewRoom();
?>

    <title>Add Objects</title>

    <h2>Add a Room</h2>

    <div id="dataForm">
        <form method="post">
            <label for="room_id">Room id</label>
            <input type="text" name="room_id" id="room_id"><br>

            <label for="room_type">Room Type</label>
            <select
                name="room_type" id="room_type">
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="twin">Twin</option>
                <option value="suite">Suite</option>
            </select><br>


            <label for="accessibility">Accessibility</label>
            <select
                name="accessibility" id="accessibility">
                <option value="wheelchair">Wheelchair Accessible</option>
                <option value="non_accessible">Non Accessible</option>
            </select><br>

            <label for="price">Price</label>
            <input type="text" name="price" id="price"><br>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>


    <!-- FOOTER -->
<?php include "templates/footer.php";?>