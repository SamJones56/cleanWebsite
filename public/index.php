<?php include "templates/header.php";
?>

<!--Carousel Source: https://getbootstrap.com/docs/5.3/components/carousel/-->

<title>Hotel Talafornia</title>

<div class="container">

    <div id="dineCarousel" class="carousel slide" Data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="6" aria-label="Slide 7"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="7" aria-label="Slide 8"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="8" aria-label="Slide 9"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="9" aria-label="Slide 10"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="10" aria-label="Slide 11"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="11" aria-label="Slide 12"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="12" aria-label="Slide 13"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="13" aria-label="Slide 14"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="14" aria-label="Slide 15"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="15" aria-label="Slide 16"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="16" aria-label="Slide 17"></button>
            <button type="button" data-bs-target="#dineCarousel" data-bs-slide-to="17" aria-label="Slide 18"></button>
        </div>
        <div class="carousel-inner">
            <!-- Main entrance -->
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="../images/miscPhotos/mainEntrance.jpg" class="d-block w-100" alt="Photo of main hotel entrance.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Hotel Tallafornia</h5>
                    <p>Have your driver drop you right at our front door!</p>
                </div>
            </div>
            <!-- Gardens -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/gardens.jpg" class="d-block w-100" alt="Photo of gardens from top of steps.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Gardens</h5>
                    <p>Stroll through our stunning gardens.</p>
                </div>
            </div>
            <!-- Shamrock dining room -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                    <input type="image" src="../images/img_rest/mainRestaurant.jpg" class="d-block w-100" alt="Photo of main restaurant area, the Shamrock Restaurant." alt="Submit" style="float:right" width="500">
                    <!--                       Edit db table and reservations page-->
                    <!--                        <input type="hidden" name="area" value="mainrest">-->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Shamrock Restaurant</h5>
                        <p>Open for dinner. Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Afternoon tea - food -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/afternoonTeaFood.jpg" class="d-block w-100" alt="PHoto of food served for afternoon tea.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Afternoon Tea</h5>
                    <p>Enjoy a selection of freshly made sandwiches and desserts.</p>
                </div>
            </div>
            <!-- Suite -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input type="image" src="../images/suite.webp" class="d-block w-100" alt="Photo of a suite." alt="Submit" style="float:right" width="500">
                    <input type="hidden" name="room_type" value="suite">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Suite</h5>
                        <p>Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Ballroom -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/ballroom.jpg" class="d-block w-100" alt="Photo of ballroom.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ballroom</h5>
                    <p>The perfect location for a wedding.</p>
                </div>
            </div>
            <!-- Bar and brasserie -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                    <input type="image" src="../images/img_rest/barSeating.jpg" class="d-block w-100" alt="Photo of bar and brasserie dining area." alt="Submit" style="float:right" width="500">
                    <!--                        Edit db table and reservations page-->
                    <!--                        <input type="hidden" name="area" value="bar">-->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Bar & Brasserie</h5>
                        <p>Open evenings only. Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Golf green with pond -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/golf1.jpg" class="d-block w-100" alt="Photo of golf green with pond.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Golf</h5>
                    <p>Book a round of golf on our private golf course.</p>
                </div>
            </div>
            <!-- Double room -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input type="image" src="../images/double.jpg" class="d-block w-100" alt="Photo of a double room." alt="Submit" style="float:right" width="500">
                    <input type="hidden" name="room_type" value="double">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Double Room</h5>
                        <p>Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Outdoor dining area -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                    <input type="image" src="../images/img_rest/outdoorDining.jpg" class="d-block w-100" alt="Photo of outdoor dining area." alt="Submit" style="float:right" width="500">
                    <!--                        Edit db table and reservations page-->
                    <!--                        <input type="hidden" name="area" value="outdoor">-->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Garden Restaurant</h5>
                        <p>Open for lunch. Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Afternoon tea drinks -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/afternoonTeaDrinks.jpg" class="d-block w-100" alt="Photo of drinks for afternoon tea.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Afternoon Tea</h5>
                    <p>Enjoy freshly made sandwiches and desserts.</p>
                </div>
            </div>
            <!-- Private gardens -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/privateGardens.jpg" class="d-block w-100" alt="Photo of private garden.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Private Gardens</h5>
                    <p>Enjoy the serenity of our private gardens.</p>
                </div>
            </div>
            <!-- Family room -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input type="image" src="../images/family.jpg" class="d-block w-100" alt="Photo of a family room." alt="Submit" style="float:right" width="500">
                    <input type="hidden" name="room_type" value="family">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Family Room</h5>
                        <p>Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Lounge bar -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="<?php $_SESSION['guestRedirect'] = "bookTable.php"; echo "signInPrompt.php"; ?>" method="post">
                    <input type="image" src="../images/img_rest/lounge.jpg" class="d-block w-100" alt="Photo of lounge area." alt="Submit" style="float:right" width="500">
                    <!--                        Edit db table and reservations page-->
                    <!--                        <input type="hidden" name="area" value="lounge">-->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Lounge</h5>
                        <p>Open for breakfast or coffee. Click to book.</p>
                    </div>
                </form>
            </div>
            <!-- Golf green -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/golf2.jpg" class="d-block w-100" alt="Photo of a golf green.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Golf</h5>
                    <p>Book a round of golf on our private golf course.</p>
                </div>
            </div>
            <!-- Private gardens -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="../images/miscPhotos/privateGardens2.jpg" class="d-block w-100" alt="Photo of private gardens.">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Private Gardens</h5>
                    <p>Enjoy the serenity of our private gardens.</p>
                </div>
            </div>
            <!-- Twin room -->
            <div class="carousel-item" data-bs-interval="3000">
                <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                    <input type="image" src="../images/twin.webp" class="d-block w-100" alt="Photo of twin room." alt="Submit" style="float:right" width="500">
                    <input type="hidden" name="room_type" value="twin">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Twin Room</h5>
                        <p>Click to book.</p>
                    </div>
                </form>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<?php include "templates/footer.php"; ?>
