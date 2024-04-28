<?php

// This function adds data to the table using an input array and the name of the table
function addToTable($connection, $inputArray, $tableName)
{
    try {
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$tableName",
            implode(", ", array_keys($inputArray)),
            ":" . implode(", :", array_keys($inputArray))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($inputArray);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// This function updates the data in a table, it takes an input array, the name of the table, the name of the key, and the given key that is associated
function updateTable($connection, $inputArray, $tableName, $keyName, $givenKey)
{
    try {
        foreach ($inputArray as $key => $value) {
            // For each key-value pair in the input array, add a set clause using placeholders
            // and add the value to the parameters array
            $bindKey[] = "$key = :$key";
            $params[":$key"] = $value;
        }
        // Combine all set clauses into a single string separated by commas
        $boundKeyString = implode(', ', $bindKey);
        // Create the SQL statement using the table name, set clause string, and key name
        $sql = "UPDATE $tableName SET $boundKeyString WHERE $keyName = :givenKey";
        // Add the given key to the parameters array
        $params[':givenKey'] = $givenKey;
        // Prepare and execute the SQL statement with the parameters
        $statement = $connection->prepare($sql);
        $statement->execute($params);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// PDO Fetch statements
// https://www.php.net/manual/en/pdostatement.fetchobject.php
// This function returns the latest pk put into a table, using a table name and the name of the pk
function getKey($connection, $tableName, $primaryKey)
{
    try {
        $sql = "SELECT MAX(" . $primaryKey . ") FROM " . $tableName;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        $result = $result_array ["MAX(" . $primaryKey . ")"];
        return $result;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// This function gets the count of the entries in a table using just the table name
function getCount($connection, $tableName)
{
    try {
        $sql = "SELECT COUNT(*) FROM " . $tableName;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        return $result_array;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// This function searches the database for an associated key to a given value
function searchDB($connection, $tableName, $searchKey, $searchValue)
{
    try {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $searchKey . " = :searchValue";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchValue', $searchValue);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        return $result_array;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// This function searched the whole database for associated key and value
function searchAllDB($connection, $tableName, $searchKey, $searchValue)
{
    try {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $searchKey . " = :searchValue";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchValue', $searchValue);
        $statement->execute();
        $result_array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result_array;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function seachAllDBcap($connection, $tableName, $searchKey, $searchValue)
{
    try {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $searchKey . " >= :searchValue";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchValue', $searchValue);
        $statement->execute();
        $result_array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result_array;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// This function searches the database for an associated key with a value
function getAssociationKey($connection, $tableName, $keyToSearch, $columnToSearch, $keyToFind)
{
    try {
        $sql = "SELECT " . $keyToFind . " FROM " . $tableName . " WHERE " . $columnToSearch . " = " . $keyToSearch;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $keyResult = $statement->fetch(PDO::FETCH_ASSOC);

        $result = $keyResult[$keyToFind];
        return $result;
    } catch (PDOException $error) {
//    echo "error" .  $sql . "<br>" . $error->getMessage();
    }
}

// This function updates a column in the database
function updateColumn($connection, $tableName, $whereKey, $updateKey, $identifyingKey, $givenIdentifyingKey)
{
    try {
        $sql = "UPDATE $tableName SET $whereKey = $updateKey WHERE $identifyingKey = $givenIdentifyingKey";
        $statement = $connection->prepare($sql);
        $statement->execute();
    } catch (PDOException $error) {
        echo "error" . $sql . "<br>" . $error->getMessage();
    }
}

// this function deletes data from the database
function deleteData($connection, $tableName, $identifyingKey, $givenKey)
{
    try {
        $sql = "DELETE FROM $tableName WHERE $identifyingKey = $givenKey";
        $statement = $connection->prepare($sql);
        $statement->execute();
    } catch (PDOException $error) {
        echo "error" . $sql . "<br>" . $error->getMessage();
    }
}