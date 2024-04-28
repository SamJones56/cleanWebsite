<?php


use person\Login;

function userLogIn($connection, $test)
{
    session_unset();
        try {
            require_once('../config.php');
            include_once "../src/functions/dataBaseFunctions.php";
            $sql = "SELECT login_id, email, password, permissionlvl from login where email = :USER";
            $statement = $connection->prepare($sql);
            $tmpUser = $_POST['Email'];
            $statement->bindParam(':USER', $tmpUser, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row => $rows) {
                $login_id_db = $rows['login_id'];
                $email_db = $rows['email'];
                $pwd_db = $rows['password'];
                $permissionlvl = $rows['permissionlvl'];
            }
                if (($_POST['Email'] == $email_db) && ($_POST['Password'] == $pwd_db))
                {
                    $_SESSION['login_id'] = $login_id_db;
                    $_SESSION['temp_login'] = $login_id_db;
                    $_SESSION['Email'] = $email_db;
                    $_SESSION['permissionlvl'] = $permissionlvl;

                    if($permissionlvl < 2) {
                        $_SESSION['customer_id'] = searchDB($connection, "member", "login_id", $login_id_db);
                    }
                    $_SESSION['Active'] = true;
                    if($test == 0) {
                            header("location:index.php");
                    }
                    else if ($test == 1){
                        header("Refresh:0");
                    }
                    exit;
                } else {
                    echo '<h1> Incorrect Email or Password </h1>';
                }

        } catch
        (Exception $e) {
            echo '<div class="messages-error">Error Logging in:' . $e->getMessage() . '</div>';
        }

}

function createLogin($connection){
    require_once '../src/person/Login.php';
    require_once '../src/functions/dataBaseFunctions.php';
    require_once '../src/DBconnect.php';

    $login = new Login();

    $login->setLoginId("100");
    $login->setPermissionlvl("3");
    $login->setPassword("PASSWORD");
    $login->setEmail("test@test.com");

    addToTable($connection, $login->toLoginArray(), "Login");
    echo '<br>Login Details Added Successfully';

}
function deleteLogin($connection){
    require_once '../src/functions/dataBaseFunctions.php';
    require_once '../src/DBconnect.php';

    deleteData($connection, "Login", "login_id", 100); //Comment out for USER SIGN IN
    echo '<br>Login Removed Successfully';
}
