<?php include "templates/header.php"; ?>

<!--Carousel Source: https://getbootstrap.com/docs/5.3/components/carousel/-->

    <title>Dine</title>

    <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Our Restaurants</h1>

    <div class="container">

        <div id="dineCarousel" class="carousel slide" Data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                        <input type="image" src="../images/img_rest/mainRestaurant.jpg" class="d-block w-100" alt="Photo of main restaurant area, the Shamrock Restaurant." alt="Submit" style="float:right" width="500">
<!--                       Edit db table and reservations page-->
<!--                        <input type="hidden" name="area" value="mainrest">-->
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Shamrock Restaurant</h5>
                            <p>Dine in our main restaurant, which takes it's name from the Shamrock Rovers.</p>
                        </div>
                    </form>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                        <input type="image" src="../images/img_rest/barSeating.jpg" class="d-block w-100" alt="Photo of bar and brasserie dining area." alt="Submit" style="float:right" width="500">
<!--                        Edit db table and reservations page-->
<!--                        <input type="hidden" name="area" value="bar">-->
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bar & Brasserie</h5>
                            <p>Enjoy a cocktail in our cosy bar and brasserie.</p>
                        </div>
                    </form>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                        <input type="image" src="../images/img_rest/outdoorDining.jpg" class="d-block w-100" alt="Photo of outdoor dining area." alt="Submit" style="float:right" width="500">
<!--                        Edit db table and reservations page-->
<!--                        <input type="hidden" name="area" value="outdoor">-->
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Garden Restaurant</h5>
                            <p>Take advantage of the great outdoors and have lunch in our garden restaurant.</p>
                        </div>
                    </form>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                        <input type="image" src="../images/img_rest/lounge.jpg" class="d-block w-100" alt="Photo of lounge area." alt="Submit" style="float:right" width="500">
<!--                        Edit db table and reservations page-->
<!--                        <input type="hidden" name="area" value="lounge">-->
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Lounge Bar</h5>
                            <p>Enjoy breakfast or a coffee in our lounge.</p>
                        </div>
                    </form>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#dineCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dineCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Menu images with links to pdf of menu -->
        <div class="menu">
            <h2>Our Menus</h2>
            <a href="../data/restaurant/breakfast.pdf" target="_blank"><img src="../images/png_menu/breakfast.png" alt="Breakfast Menu" width="300"></a>
            <a href="../data/restaurant/lunch.pdf" target="_blank"><img src="../images/png_menu/lunch.png" alt="Lunch Menu" width="300"></a>
            <a href="../data/restaurant/dinner.pdf" target="_blank"><img src="../images/png_menu/dinner.png" alt="Dinner Menu" width="300"></a>
        </div>

        <!-- Book button -->
        <!-- <a href="bookTable.php" class="book-btn">Book Now</a> -->
<!--        <a href="bookTable.php">-->
<!--            <button style="font-size:32px; background-color:#54aeff; color:rgba(0,0,0,0.85); padding:10px; border:none; box-shadow: 0 2px 4px rgba(0,0,0,0.69);">-->
            <form action="<?php
            $_SESSION['guestRedirect'] = "bookTable.php";
            echo "signInPrompt.php";
            ?>" method="post">
                <button type="submit" class="btn btn-success">Book Now</button>
            </form>
        </a>

    </div>

<?php include "templates/footer.php"; ?>