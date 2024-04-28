<?php
// Build a list of all the tables
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
// Print the data
function printData ($tableData, $searchKey){
    foreach ($tableData as $data) {
        echo "<td>" . $data . "</td>";
    }
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="item_id" value="' . ($tableData[$searchKey]) . '">';
    echo '<td><input type="submit" name="submit_post" value="Edit" class="btn btn-warning"></td>';
    echo '<td><input type="submit" name="delete_post" value="Delete" class="btn btn-danger"></td>';
    echo '</form></td>';
    echo "</tr>";
}

function getItemToUpdate($connection, $tableName, $searchKey, $searchValue)
{
    return $tempData = searchDB($connection, $tableName,$searchKey, $searchValue);
}
