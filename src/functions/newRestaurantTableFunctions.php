<?php

use hotel\RestaurantTable;
// This function creates a new table
function makeNewRestaurantTable()
{
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/hotel/RestaurantTable.php';

        // Create restaurantTable object
        $restTable = new RestaurantTable();

        // set restaurantTable attributes
        $restTable->setTableId(escape($_POST['table_id']));
        $restTable->setCapacity(escape($_POST['capacity']));

        // Add to the restaurantTable database
        addToTable($connection, $restTable->toRestaurantTableArray(), "restauranttables");
    }
}