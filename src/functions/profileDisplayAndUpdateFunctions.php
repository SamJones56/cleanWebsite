<?php

function newProfileDisplay($login_id, $isEmployee, $connection)
{
    require_once "../common.php";
    include_once "dataBaseFunctions.php";

    if ($isEmployee) {

        // Get the employee_id by searching in the employee table
        $employee_id = getAssociationKey($connection, "employee", $login_id, "login_id", "employee_id");

        // Get the user id by searching in the employee table
        $user_id = getAssociationKey($connection, "employee", $employee_id, "employee_id", "user_id");

        // Search user table for data
        $temp_array = searchDB($connection, "user", "user_id", $user_id);

        // Search employee table for data
        $temp_array = $temp_array + searchDB($connection, "employee", "employee_id", $employee_id);

        // Search login table for data
        $temp_array = $temp_array + searchDB($connection, "login", "login_id", $login_id);

        // Add employee_id
        $temp_array['employee_id'] = $employee_id;

        return $temp_array;
    } else {
        // Get the employee_id by searching in the customer table
        $customer_id = getAssociationKey($connection, "member", $login_id, "login_id", "customer_id");

        // Get the user id by searching in the customer table
        $user_id = getAssociationKey($connection, "customer", $customer_id, "customer_id", "user_id");

        $member_id = getAssociationKey($connection, "member", $login_id, "login_id", "member_id");

        // Search user table for data
        $temp_array = searchDB($connection, "user", "user_id", $user_id);

        // Search employee table for data
        $temp_array = $temp_array + searchDB($connection, "customer", "customer_id", $customer_id);

        // Search login table for data
        $temp_array = $temp_array + searchDB($connection, "login", "login_id", $login_id);

        // Add the member_id
        $temp_array['member_id'] = $member_id;

        return $temp_array;
    }
}

use person\Member;
use person\Employee;

function buildProfileDisplay($userArray, $isEmployee)
{ ?>
    <h2>Edit a user</h2>
    <form method="post">
        <!--https://www.w3schools.com/php/php_arrays_remove.asp#:~:text=To%20remove%20items%20from%20an,item%20you%20want%20to%20delete.-->
        <!-- Takes away user details -->
        <?php
        unset($userArray["user_id"], $userArray["Login_id"]);
        if (!$isEmployee) {
            unset($userArray["customer_id"], $userArray["permissionlvl"]);
        } else {
            unset($userArray["employee_id"], $userArray["dept_id"]);
        }
        foreach ($userArray as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input class="form-control" type="text" name="<?php echo $key; ?>" id="<?php echo $key;
            ?>" value="<?php echo escape($value); ?>" <?php echo($key === 'id' ?
                'readonly' : null); ?>>
        <?php endforeach; ?>
        <?php ?>
        <br>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        <a class="btn btn-secondary" href="<?php echo $_SESSION['guestRedirect']; ?>">Back</a>
    </form>

<?php }

function buildUser($userArray, $isEmployee, $connection)
{
    require_once "../common.php";
    include_once "dataBaseFunctions.php";
    require_once '../src/person/Member.php';
    require_once '../src/person/Employee.php';

    echo "<br>";
    echo '<h1> Test </h1>';
    var_dump($userArray);
    var_dump($isEmployee);
    echo "<br>";
    if (!$isEmployee) {
        $member = new Member();
        // Update $userArray with new data, value is passed by reference so it can be changed
//        https://www.php.net/manual/en/language.references.pass.php
        foreach ($userArray as $key => &$value) {
            // Logic to find a change
            if (isset($_POST[$key]) && $value != $_POST[$key]) {
                // Update the value to the correct value in the form
                $value = $_POST[$key];
            }
        }

        $member->setFilledMember($userArray);

        updateTable($connection, $member->getUserArray(), "user", "user_id", $userArray['user_id']);
        updateTable($connection, $member->toLoginArray(), "login", "Login_id", $userArray['Login_id']);
        updateTable($connection, $member->toCustomerArray(), "customer", "customer_id", $userArray['customer_id']);
        updateTable($connection, $member->toMemberArray(), "member", "member_id", $userArray['member_id']);
    } // Check for employee
    else {
        $employee = new Employee();
        // Update $userArray with new data, value is passed by reference so it can be changed
//        https://www.php.net/manual/en/language.references.pass.php
        foreach ($userArray as $key => &$value) {
            // Logic to find a change
            if (isset($_POST[$key]) && $value != $_POST[$key]) {
                // Update the value to the correct value in the form
                $value = $_POST[$key];
            }
        }
        // Set the data into employee
        $employee->setFilledEmployee($userArray);

        updateTable($connection, $employee->getUserArray(), "user", "user_id", $userArray['user_id']);
        updateTable($connection, $employee->toLoginArray(), "login", "Login_id", $userArray['login_id']);
        updateTable($connection, $employee->toEmployeeArray(), "employee", "employee_id", $userArray['employee_id']);
    }
//https://stackoverflow.com/questions/12383371/refresh-a-page-using-php
    // Refresh page
//    header("Refresh:0");
}