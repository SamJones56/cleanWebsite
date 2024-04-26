<?php

function buildTableList($connection, $tableName, $searchKey)
{
    include_once "dataBaseFunctions.php";
    $retrievedData = [];
    $count = getKey($connection, $tableName, $searchKey);
    for ($i = 0; $i <= $count; $i++) {
        $searched = searchDB($connection, $tableName, $searchKey, $i);
        if($searched) {
            $retrievedData[] = $searched;
        }
    }
    return $retrievedData;
}

function printData ($tableData, $searchKey){
    foreach ($tableData as $data) {
        echo "<td>" . $data . "</td>";
    }
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="item_id" value="' . ($tableData[$searchKey]) . '">';
    echo '<input type="submit" name="submit_room" value="Edit">';
    echo '</form></td>';
    echo "</tr>";
}

function getItemToUpdate($connection, $tableName, $searchKey, $searchValue)
{
    return $tempData = searchDB($connection, "rooms","room_id", $_SESSION['tempEdit']);
}