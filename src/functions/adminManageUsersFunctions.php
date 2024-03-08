<?php

function buildUserList($connection)
{
    include_once "../src/Functions/profileDisplayAndUpdateFunctions.php";
    include_once "dataBaseFunctions.php";
//  Get user count
//    Loop through and get data for each
//    add buttons to edit
//    redirect on buttons bringing with you the selected user login id


    // Get count of users
    $count = getKey($connection, "login", "login_id");

//    var_dump($count);
    for ($i = 0; $i <= $count; $i++) {
        // Start gathering data for each user in table
        $login = searchDB($connection, "login", "login_id", $i);

        // Check for null searches
        if ($login) {
            $tempArray = $login;
            // Check for member
            if ($login['permissionlvl'] == 1) {
                $login_id = $login['Login_id'];
                $isEmployee = false;
                $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
                buildMemberDisplay($tempArray);
            } else {
                $login_id = $login['Login_id'];
                $isEmployee = true;
                $tempArray = newProfileDisplay($login_id, $isEmployee, $connection);
                buildEmployeeDisplay($tempArray);
            }
        }
    }
}

function buildDisplayListHeaders()
{

}

function buildEmployeeDisplay($userArray)
{ ?>

    <tr>
    <?php foreach ($userArray as $key => $value) { ?>

        <td> <?php echo $value; } ?> <td>
    </tr>
<?php }


function buildMemberDisplay($userArray)
{ ?>

    <tr>
        <?php foreach ($userArray as $key => $value) { ?>

        <td> <?php echo $value; } ?> <td>
    </tr>
<?php }

