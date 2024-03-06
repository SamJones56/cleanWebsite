<?php


function addToTable($connection, $inputArray, $tableName){
    try {
    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "$tableName",
        implode(", ", array_keys($inputArray)),
        ":" . implode(", :", array_keys($inputArray))
    );
    $statement = $connection->prepare($sql);
    $statement->execute($inputArray);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// https://www.php.net/manual/en/pdostatement.fetchobject.php
function getKey($connection, $tableName, $primaryKey){
//    require_once '../src/DBconnect.php';
    try {
        $sql = "SELECT MAX(" . $primaryKey . ") FROM " . $tableName;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        $result = $result_array ["MAX(". $primaryKey .")"];
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function searchDB($connection, $tableName, $searchKey, $searchValue)
{
    try {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $searchKey . " = :searchValue";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchValue', $searchValue);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        return $result_array;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getAssociationKey($connection, $tableName, $keyToSearch, $columnToSearch ,$keyToFind){
    try{
        $sql = "SELECT " . $keyToFind . " FROM " . $tableName . " WHERE " . $columnToSearch . " = " . $keyToSearch;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $keyResult = $statement->fetch(PDO::FETCH_ASSOC);
        $result = $keyResult[$keyToFind];
        return $result;
    } catch(PDOException $error) {
    echo "error" .  $sql . "<br>" . $error->getMessage();
    }
}