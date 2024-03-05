<!--source: https://getbootstrap.com/docs/5.3/examples/headers/-->
<?php session_start();

$user_is_logged_in = isset($_SESSION['login_id']);
if ($user_is_logged_in) {
    $_SESSION['Active'] = true;
} else {
    $_SESSION['Active'] = false;
    $_SESSION['permissionlvl'] = 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../Bootstrap/bootstrap-5.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>-->
</head>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="20" height="32"><use xlink:href="index.php"></use></svg>
            <span class="fs-4">Hotel Tallafornia</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Stay</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Dine</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Gallery</a></li>
            <?php if($_SESSION['permissionlvl'] == 3){?>
			    <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
            <?php } ?>
        </ul>
<!--        Begin checks for logged in                  -->
        <?php if($_SESSION['Active'] == false){ ?>
        <div class="col-md-3 text-end">
            <a href="./userLogin.php" class="btn btn-outline-primary me-2">Login</a>
            <a href="./memberSignUp.php"  class="btn btn-primary">Sign-up</a>
        </div>
        <?php }
        else if($_SESSION['Active'] == true){ ?>
        <div class="col-md-3 text-end">
            <a href="./profile.php" class="btn btn-outline-primary me-2">Profile</a>
            <a href="./userLogout.php"  class="btn btn-primary">Log-out</a>
        </div>
        <?php }?>
    </header>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<body>
