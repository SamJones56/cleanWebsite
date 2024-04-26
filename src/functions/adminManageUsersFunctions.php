<?php

function buildEmployeeList($connection) {
    include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    $count = getKey($connection, "login", "Login_id");

    for ($i = 0; $i <= $count; $i++) {
        $login = searchDB($connection, "login", "Login_id", $i);

        if ($login && $login['permissionlvl'] >= 2) {
            $login_id = $login['Login_id'];
            $isEmployee = true;
            $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
            buildEmployeeDisplay($tempArray);
        }
    }
}

function buildMemberList($connection) {
    include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";

    $count = getKey($connection, "login", "login_id");

    for ($i = 0; $i <= $count; $i++) {
        $login = searchDB($connection, "login", "login_id", $i);

        if ($login && $login['permissionlvl'] < 2) {
            $login_id = $login['Login_id'];
            $isEmployee = false;
            $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
            buildMemberDisplay($tempArray);
        }
    }
}

function buildEmployeeDisplay($userArray)
{
    echo("<br>");
    if(isset($_POST['submit_employee'])){
        $temp_login = $_POST['user_id'];
        $_SESSION['temp_login'] = $temp_login;
        $_SESSION['tempEmployee'] = true;
        header("Location: updateUser.php");
        exit();
    }

    // Keys that match headers

    $keys = ['Login_id','user_id', 'name', 'address', 'ph_no', 'email', 'dob', 'dept_id', 'job'];

    echo "<tr>";
    foreach ($keys as $key) {
//        https://www.w3schools.com/php/func_array_key_exists.asp
        // Check if the key exists in the userArray
        if (array_key_exists($key, $userArray)) {
            echo "<td>" . $userArray[$key]  . "</td>";
        } else {
            // Doesn't match
            echo "<td></td>";
        }
    }

    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="user_id" value="' . ($userArray['Login_id']) . '">';
    echo '<input type="submit" name="submit_employee" value="Edit">';
    echo '</form></td>';
    echo "</tr>";

}

function buildMemberDisplay($userArray)
{
    if(isset($_POST['submit_member'])){
        $temp_login = $_POST['user_id'];
        $_SESSION['temp_login'] = $temp_login;
        $_SESSION['tempEmployee'] = false;
        header("Location: updateUser.php");
        exit();
    }
    // Keys that match headers
    $keys = ['user_id', 'name', 'address', 'ph_no', 'email', 'dob', 'passport_no' ];

    echo "<tr>";
    foreach ($keys as $key) {
        // Check if the key exists in the userArray
        if (array_key_exists($key, $userArray)) {
            echo "<td>" . $userArray[$key] . "</td>";
        } else {
            // Doesn't match
            echo "<td></td>";
        }
    }
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="user_id" value="' . ($userArray['Login_id']) . '">';
    echo '<input type="submit" name="submit_member" value="Edit">';
    echo '</form></td>';
    echo "</tr>";
}



