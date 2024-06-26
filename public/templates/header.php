<!--source: https://getbootstrap.com/docs/5.3/examples/headers/-->
<?php
// ob_start buffer for echo's https://www.php.net/manual/en/function.ob-start.php
ob_start();
session_start();

$user_is_logged_in = isset($_SESSION['login_id']);
if ($user_is_logged_in) {
    $_SESSION['Active'] = true;
    if ($_SESSION['permissionlvl'] > 1) {
        $_SESSION['isEmployee'] = true;
    } else
        $_SESSION['isEmployee'] = false;
} else {
    $_SESSION['Active'] = false;
    $_SESSION['permissionlvl'] = 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="../Bootstrap/bootstrap-5.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.
css">
    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>-->
</head>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php"
           class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="20" height="32">
                <use xlink:href="index.php"></use>
            </svg>
            <span class="fs-4" style="color: #5cb85c">Hotel Tallafornia</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a style="color: #13653f" href="index.php" class="nav-link"
                                    aria-current="page">Home</a></li>
            <li class="nav-item"><a href="stays.php" class="nav-link" style="color: #13653f">Stay</a></li>
            <li class="nav-item"><a href="dine.php" class="nav-link" style="color: #13653f">Dine</a></li>
            <li class="nav-item"><a href="gallery.php" class="nav-link" style="color: #13653f">Gallery</a></li>
            <?php if ($_SESSION['permissionlvl'] > 1) { ?>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/admin.php') ? 'active' : ''; ?>"><a
                            href="admin.php" class="nav-link" style="color: #13653f">Staff</a></li>
            <?php } ?>
        </ul>
        <!--        Begin checks for logged in                  -->
        <?php if ($_SESSION['Active'] == false) { ?>
            <div class="col-md-3 text-end">
                <a href="./userLogin.php" class="btn btn-outline-success me-2">Login</a>
                <a href="./memberSignUp.php" class="btn btn-success">Sign-up</a>
            </div>
        <?php } else if ($_SESSION['Active'] == true) { ?>
            <div class="col-md-3 text-end">
                <a href="./profile.php" class="btn btn-outline-success me-2">Profile</a>
                <a href="./userLogout.php" class="btn btn-success">Log-out</a>
            </div>
        <?php } ?>
    </header>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<body>
<div class="container">

    <?php
    //var_dump($_SESSION['temp_room_type']);
    //var_dump($_SESSION);
    ?>
