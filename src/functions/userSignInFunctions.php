<?php

function userLogIn()
{
    session_unset();
    if (isset($_POST['Submit'])) {

        //If email has correct format|| password invalid
        //

        //If

        try {
            require_once('../config.php');
            include_once "../src/functions/dataBaseFunctions.php";
            $connection = new PDO($dsn, $username, $password, $options);
            $sql = "SELECT login_id, email, password, permissionlvl from login where email = :USER";
            $statement = $connection->prepare($sql);
            $tmpUser = $_POST['Email'];
            $statement->bindParam(':USER', $tmpUser, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row => $rows){
                $login_id_db = $rows['login_id'];
                $email_db = $rows['email'];
                $pwd_db = $rows['password'];
                $permissionlvl = $rows['permissionlvl'];
            }
                if (($_POST['Email'] == $email_db) && ($_POST['Password'] == $pwd_db))
                {
                    $_SESSION['login_id'] = $login_id_db;
                    $_SESSION['temp_login'] = $login_id_db;
                    $_SESSION['email'] = $email_db;
                    $_SESSION['permissionlvl'] = $permissionlvl;
                    if($permissionlvl < 2) {
                        $_SESSION['customer_id'] = searchDB($connection, "member", "login_id", $login_id_db);
                    }
                    $_SESSION['Active'] = true;

                    header("location:index.php");
                    exit;
                }
                else {
                    echo 'Incorrect Email or Password';
                }

        } catch
        (Exception $e) {
            echo '<div class="messages-error">Error Logging in:' . $e->getMessage() . '</div>';
        }
    }
}

