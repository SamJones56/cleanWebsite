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


//        var_dump($room);
        // Add to the room table
        addToTable($connection, $room->toRoomArray(), "rooms");
    }
}

function updateRoom($connection){
    if (isset($_POST['submit'])) {
        require "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once '../src/hotel/Room.php';

        $room = new Room();

        // Set room attributes
        $room->setRoomId(escape($_POST['room_id']));
        $room->setRoomType(escape($_POST['room_type']));
        $room->setAccessibility(escape($_POST['accessibility']));
        $room->setPrice(escape($_POST['price']));

        updateTable($connection, $room->toRoomArray(), "rooms", "room_id", $room['room_id']);
    }
}