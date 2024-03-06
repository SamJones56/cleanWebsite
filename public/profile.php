<?php
include "../src/Functions/profileDisplayFunctions.php";
include "templates/header.php";

$user_array = newProfileDisplay($_SESSION['login_id'], $_SESSION['isEmployee']);
?>

<h2>Results</h2>
<table>
    <thead>
    <tr>
        <th>User id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <?php if($_SESSION['isEmployee']){ ?>
            <th>Department id</th>
            <th>job</th>
        <?php } else{ ?>
            <th>Passport number</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $user_array["user_id"]; ?></td>
            <td><?php echo $user_array["name"]; ?></td>
            <td><?php echo $user_array["address"]; ?></td>
            <td><?php echo $user_array["ph_no"]; ?></td>
            <td><?php echo $user_array["email"]; ?></td>
            <td><?php echo $user_array["dob"]; ?></td>
            <?php if($_SESSION['isEmployee']){ ?>
                <td><?php echo $user_array["dept_id"]; ?></td>
                <td><?php echo $user_array["job"]; ?></td>
            <?php }else{?>
            <td><?php echo $user_array["passport_no"]; ?></td>
            <?php }?>
            <td><a href="test.php?user_id=<?php echo $user_array["user_id"];
                ?>">Edit</a></td>
        </tr>
    </tbody>
</table>
