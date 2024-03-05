<?php

function userLogIn()
{
    if (isset($_POST['Submit'])) {
        try {
            require_once('../config.php');
            $connection = new PDO($dsn, $username, $password, $options);
            $sql = "SELECT login_id, email, password from login where email = :USER";
            $statement = $connection->prepare($sql);
            $tmpUser = $_POST['Email'];
            $statement->bindParam(':USER', $tmpUser, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row => $rows)
            {
                $login_id_db = $rows['login_id'];
                $email_db = $rows['email'];
                $pwd_db = $rows['password'];
                if (($_POST['Email'] == $email_db) && ($_POST['Password'] == $pwd_db))
                {
                    $_SESSION['login_id'] = $login_id_db;
                    $_SESSION['Email'] = $email_db;
                    $_SESSION['Active'] = true;

                    header("location:index.php");
                    exit;
                } else {
                    echo 'Incorrect Email or Password';
                }
            }
        } catch
        (Exception $e) {
            echo '<div class="messages-error">Error Logging in:' . $e->getMessage() . '</div>';
        }
    }
}
