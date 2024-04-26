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




function updateTable($connection, $inputArray, $tableName, $keyName, $givenKey)
{
    try{
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

function getCount($connection, $tableName)
{
    try{
        $sql = "SELECT COUNT(*) FROM " . $tableName ;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result_array = $statement->fetch(PDO::FETCH_ASSOC);
        return $result_array;
    }catch(PDOException $error) {
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

function searchAllDB($connection, $tableName, $searchKey, $searchValue)
{
    try {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $searchKey . " = :searchValue";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchValue', $searchValue);
        $statement->execute();
        $result_array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result_array;
    } catch(PDOException $error) {
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
//    echo "error" .  $sql . "<br>" . $error->getMessage();
    }
}

function updateColumn($connection, $tableName, $whereKey, $updateKey, $identifyingKey, $givenIdentifyingKey)
{
    try
    {
        $sql = "UPDATE $tableName SET $whereKey = $updateKey WHERE $identifyingKey = $givenIdentifyingKey";
        $statement = $connection->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo "error" .  $sql . "<br>" . $error->getMessage();
    }
}

function deleteData($connection, $tableName, $identifyingKey, $givenKey)
{
    try
    {
        $sql = "DELETE FROM $tableName WHERE $identifyingKey = $givenKey";
        $statement = $connection->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo "error" .  $sql . "<br>" . $error->getMessage();
    }
}