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
        header("location:" . $_SESSION['guestRedirect']);
    }
}

function updateRestTable($connection)
{
    // Form submitted
    if (isset($_POST['submit'])) {
        require "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once '../src/hotel/RestaurantTable.php';

        // Create new department object
        $table = new RestaurantTable();
        // Set department attributes
        $table->setTableId(escape($_POST['table_id']));
        $table->setCapacity(escape($_POST['capacity']));
        // Update the table
        updateTable($connection, $table->toRestaurantTableArray(), "restauranttables", "table_id", $table->getTableId());
        // Redirect user
        header("location:" . $_SESSION['guestRedirect']);
    }
}