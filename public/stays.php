<?php
include "templates/header.php";
if (isset($_SESSION['temp_room_reservation'])) {
    unset($_SESSION['temp_room_reservation']);
}
?>

<title>Stays</title>
<h2>Our Rooms</h2>
<!--Source - Bootstrap Code: https://getbootstrap.com/docs/5.3/components/carousel/#how-it-works-->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <h5>Classic Double</h5>
            <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/doubleBook.jpg" alt="Submit" style="grid" width=95%>
                <input type="hidden" name="room_type" value="double">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Aliquam eleifend mi in
                    nulla posuere. </p>
            </form>
        </div>


        <div class="carousel-item">
            <h5>Luxury Suite</h5>
            <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/suiteBook.jpg" alt="Submit" style="grid" width=95%>
                <input type="hidden" name="room_type" value="double">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Aliquam eleifend mi in
                    nulla posuere.</p>
            </form>


        </div>
        <div class="carousel-item">
            <h5>Classic Twin</h5>
            <form action="signInPrompt.php<?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/twinBook.jpg" alt="Submit" style="grid" width=95%>
                <input type="hidden" name="room_type" value="twin">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Aliquam eleifend mi in
                    nulla posuere.</p>
            </form>


        </div>

        <div class="carousel-item">
            <h5>Deluxe Family</h5>
            <form action="signInPrompt.php<?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/familyBook.jpg" alt="Submit" style="grid" width=95%>
                <input type="hidden" name="room_type" value="family">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Aliquam eleifend mi in
                    nulla posuere.</p>
            </form>
            </form>


        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php include "templates/footer.php"; ?>
