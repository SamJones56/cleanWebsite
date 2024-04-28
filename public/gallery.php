<?php include "templates/header.php"; ?>

    <!-- Gallery source: https://startbootstrap.com/snippets/thumbnail-gallery -->

    <div class="container">

        <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Gallery</h1>

        <hr class="mt-2 mb-5">

        <div class="row text-center text-lg-start">

            <div class="col-lg-3 col-md-4 col-6">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <!--                    <img class="img-fluid img-thumbnail" src="../images/suite.webp" alt="Photo of suite">-->
                    <input class="img-fluid img-thumbnail" type="image" src="../images/suite.webp">
                    <input type="hidden" name="room_type" value="suite">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/double.jpg">
                    <input type="hidden" name="room_type" value="double">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/family.jpg">
                    <input type="hidden" name="room_type" value="family">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/twin.webp">
                    <input type="hidden" name="room_type" value="twin">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php";
                echo "signInPrompt.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/img_rest/mainRestaurant.jpg">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php";
                echo "signInPrompt.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/img_rest/barSeating.jpg">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php";
                echo "signInPrompt.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/img_rest/lounge.jpg"
                           class="d-block w-100" alt="Photo of lounge area." alt="Submit" style="float:right"
                           width="500">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php";
                echo "signInPrompt.php"; ?>" method="post">
                    <input class="img-fluid img-thumbnail" type="image" src="../images/img_rest/outdoorDining.jpg">
                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="../images/miscPhotos/golf1.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="../images/miscPhotos/gardens.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="../images/miscPhotos/afternoonTeaFood.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="../images/roomAdons/hotel_tallaght.png" alt="">
                </a>
            </div>
        </div>

    </div>

<?php include "templates/footer.php"; ?>