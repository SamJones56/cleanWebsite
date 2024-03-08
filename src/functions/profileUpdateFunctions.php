<?php
use person\Member;
use person\Employee;
function buildTable($userArray, $isEmployee)
{ ?>
        <h2>Edit a user</h2>
        <form method="post">
            <?php if(!$isEmployee){ ?>
                <!--https://www.w3schools.com/php/php_arrays_remove.asp#:~:text=To%20remove%20items%20from%20an,item%20you%20want%20to%20delete.-->
                <!-- Takes away user details -->
                <?php unset($userArray["user_id"], $userArray["customer_id"], $userArray["Login_id"], $userArray["permissionlvl"]); }?>
                <?php foreach ($userArray as $key => $value) : ?>
                <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
                <input type="text" name="<?php echo $key; ?>" id="<?php echo $key;
                ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ?
                'readonly' : null); ?>>
                <?php endforeach; ?>
    <?php ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
<?php }

//function buildUser($userArray, $isEmployee)
//{
//    require_once "../common.php";
//    include "../src/functions/dataBaseFunctions.php";
//    require_once '../src/DBconnect.php';
//    require_once '../src/person/Member.php';
//    require_once '../src/person/Employee.php';
//
//    if(!$isEmployee)
//    {
//        $member = new Member();
//        $member->setFilledMember($userArray);
//
//        updateTable($connection, $member->toUserFullArray(), "user", "user_id", $userArray['user_id']);
//        updateTable($connection, $member->toLoginArray(), "login", "login_id", $userArray['login_id']);
//        updateTable($connection, $member->toCustomerFullArray(), "customer", "customer_id", $userArray['customer_id']);
//        updateTable($connection, $member->toMemberFullArray(), "member", "member_id", $userArray['member_id']);
//    }
//    else
//    {
//
//    }
//        // User atributes of member
//        $member->setUserId(escape($userArray['user_id']));
//        $member->setName(escape($userArray['name']));
//        $member->setAddress(escape($userArray['address']));
//        $member->setPhNo(escape($userArray['ph_no']));
//        $member->setDob(escape($userArray['dob']));
//
//        // Update user table
//        updateTable($connection, $member->toUserFullArray(), "user", "user_id", escape($userArray['user_id']));
//
//        // Login attributes of member
//        $member->setLoginId(escape($userArray['login_id']));
//        $member->setLoginDetails(escape($userArray['email']), escape($userArray['password']), escape($userArray['permissionlvl']));
//
//        // Update login table
//        updateTable($connection, $member->toLoginArray(), "login", "login_id", escape($userArray['login_id']));
//
//        // Customer attributes
//        $member->setMemberId(escape($userArray['member_id']));
//        $member->setCustomerId(escape($userArray['customer_id']));
//}


