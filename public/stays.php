<?php
include "templates/header.php";
if(isset($_SESSION['temp_room_reservation'])){
    unset($_SESSION['temp_room_reservation']);
}
?>

<title>Stays</title>
<h2>Click to Reserve</h2>
<!--Source - Bootstrap Code: https://getbootstrap.com/docs/5.3/components/carousel/#how-it-works-->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/double.jpg" alt="Submit" style="grid" width=100%>
                <input type="hidden" name="room_type" value="double">
                <h5>Suite</h5>
                <p>Fill w/ non  plagarised </p>
            </form>
        </div>


        <div class="carousel-item">
            <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/suite.webp" alt="Submit" style="grid" width=100%>
                <input type="hidden" name="room_type" value="double">
                <h5>Double</h5>
                <p>Fill w/ non  plagarised </p>
            </form>


        </div>
        <div class="carousel-item">

            <form action="signInPrompt.php<?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/twin.webp" alt="Submit" style="grid" width=100%>
                <input type="hidden" name="room_type" value="twin">
                <h5>Twin</h5>
                <p>Fill w/ non  plagarised </p>
            </form>


        </div>

        <div class="carousel-item">

            <form action="signInPrompt.php<?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
                <input type="image" src="../images/family.jpg" alt="Submit" style="grid" width=100%>
                <input type="hidden" name="room_type" value="family">
                <h5>Family</h5>
                <p>Fill w/ non  plagarised </p>
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
