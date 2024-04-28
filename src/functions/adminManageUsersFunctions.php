<?php
// This function builds an array of all employees and builds the display
function buildEmployeeList($connection)
{
    include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
    // Get a count of all employee entries in the db
    $count = getKey($connection, "login", "Login_id");
    // Loop through all the entries
    for ($i = 0; $i <= $count; $i++) {
        // Get the login_id's of each entry
        $login = searchDB($connection, "login", "Login_id", $i);
        // Check to see if the data received is an employee via their permission lvl
        if ($login && $login['permissionlvl'] >= 2) {
            // Set necessary attributes
            $login_id = $login['Login_id'];
            $isEmployee = true;
            // Get the array for the employee
            $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
            // Build the display
            buildEmployeeDisplay($tempArray);
        }
    }
}

// This function builds an array of all members and builds the display
function buildMemberList($connection)
{
    include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
    // Get a count of all member entries in the db
    $count = getKey($connection, "login", "login_id");
    // Loop through
    for ($i = 0; $i <= $count; $i++) {
        // Search the db with the login id
        $login = searchDB($connection, "login", "login_id", $i);
        // Confirm it's a member using permission lvl
        if ($login && $login['permissionlvl'] < 2) {
            $login_id = $login['Login_id'];
            $isEmployee = false;
            // Get the array for the member
            $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
            // Build the display
            buildMemberDisplay($tempArray);
        }
    }
}

// This function builds the display for the employee
function buildEmployeeDisplay($userArray)
{
    // Handle the submission, edit the correct employee
    if (isset($_POST['submit_employee'])) {
        $temp_login = $_POST['user_id'];
        $_SESSION['temp_login'] = $temp_login;
        $_SESSION['tempEmployee'] = true;
        header("Location: updateUser.php");
    }
    // Keys that match headers
    $keys = ['Login_id', 'user_id', 'name', 'address', 'ph_no', 'email', 'dob', 'dept_id', 'job'];
    echo "<tr>";
    // loop through each of the keys
    foreach ($keys as $key) {
//        https://www.w3schools.com/php/func_array_key_exists.asp
        // Check if the key exists in the userArray
        if (array_key_exists($key, $userArray)) {
            // If it exists, then print the value
            echo "<td>" . $userArray[$key] . "</td>";
        } else {
            // Doesn't match, do nothing
            echo "<td></td>";
        }
    }
    // Declare a form, with a hidden value that links to the edit button
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="user_id" value="' . ($userArray['Login_id']) . '">';
    echo '<input type="submit" name="submit_employee" value="Edit" class="btn btn-warning">';
    echo '</form></td>';
    echo "</tr>";

}

function buildMemberDisplay($userArray)
{
    // Handle the submission, edit the correct member
    if (isset($_POST['submit_member'])) {
        $temp_login = $_POST['user_id'];
        $_SESSION['temp_login'] = $temp_login;
        $_SESSION['tempEmployee'] = false;
        header("Location: updateUser.php");
    }
    // Keys that match headers
    $keys = ['user_id', 'name', 'address', 'ph_no', 'email', 'dob', 'passport_no'];
    echo "<tr>";
    // loop through each of the keys
    foreach ($keys as $key) {
        // Check if the key exists in the userArray
        if (array_key_exists($key, $userArray)) {
            // If it exists, then print the value
            echo "<td>" . $userArray[$key] . "</td>";
        } else {
            // Doesn't match, do nothing
            echo "<td></td>";
        }
    }
    // Declare a form, with a hidden value that links to the edit button
    echo '<td><form action="" method="post">';
    echo '<input type="hidden" name="user_id" value="' . ($userArray['Login_id']) . '">';
    echo '<input type="submit" name="submit_member" value="Edit" class="btn btn-warning">';
    echo '</form></td>';
    echo "</tr>";
}



