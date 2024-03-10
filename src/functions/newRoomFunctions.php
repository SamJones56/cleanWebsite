<?php

use hotel\Room;

function makeNewRoom()
{
    if (isset($_POST['submit'])) {

        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/hotel/Room.php';

        // Create room object
        $room = new Room();

        // Set room attributes
        $room->setRoomId(escape($_POST['room_id']));
        $room->setRoomType(escape($_POST['room_type']));
        $room->setAccessibility(escape($_POST['accessibility']));
        $room->setPrice(escape($_POST['price']));

        // Add to the room table
        addToTable($connection, $room->toRoomArray(), "rooms");
    }
}