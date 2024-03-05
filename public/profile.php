<?php include "templates/header.php";

try {
    $login_id = $_SESSION['login_id'];
    require "../common.php";
    require_once '../src/DBconnect.php';
    $sql = "SELECT 
            u.name, 
            u.address, 
            u.ph_no, 
            u.dob, 
            l.email, 
            e.job, 
            c.passport_no
        FROM login l
        LEFT JOIN employee e ON l.Login_id = e.login_id
        LEFT JOIN user u ON e.user_id = u.user_id
        LEFT JOIN customer c ON u.user_id = c.user_id
        WHERE l.Login_id = $login_id;";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':login_id', $login_id, PDO::PARAM_INT);
    $statement->execute();


    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>

<h2>Update Profile</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Location</th>
            <th>Date</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["address"]); ?></td>
                <td><?php echo escape($row["ph_no"]); ?></td>
                <td><?php echo escape($row["dob"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["job"]); ?></td>
                <td><?php echo escape($row["passport_no"]); ?> </td>
                <td><a href="update-single.php?id=<?php echo escape($row["name"]);
                    ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Back to home</a>
<?php include "templates/footer.php"; ?>