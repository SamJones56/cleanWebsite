<?php

function buildTable($userArray, $isEmployee)
{ var_dump($userArray);?>
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


function splitArrayUpdate($userArray, $isEmployee)
{
    $loginData = $userArray["Login_id"] + $userArray["email"] + $userArray["password"] + $userArray["permissionlvl"];
    $userData = $userArray["user_id"] + $userArray["name"] + $userArray["address"] + $userArray["ph_no"] + $userArray["dob"];
    if($isEmployee)
    {
        $employeeData = $userArray["job"];
    }
    else
    {
        $customerData = $userArray["passport_no"];
    }
}

