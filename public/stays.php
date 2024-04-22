<?php
include "templates/header.php";
?>

<title>Stays</title>
<div class ="grid-container">
    <div class="Suite">
<!--        <img src="../images/suite.webp" width="500">-->

        <h4>Suite</h4>
        <p>These one-bedroom suites feature one king signature featherbed for maximum comfort, and a walk-in wardrobe with plenty of space. The Classic King Suites, with 731sqft / 68sqm, include a large living area with comfortable furnishings, making it the perfect setting for a relaxing stay. Marble bathrooms with ESPA bath essentials, recessed TV, fluffy robes and rainforest showers guarantee a luxury experience.</p>
        <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
            <input type="image" src="../images/suite.webp" alt="Submit" style="float:right" width="500">
            <input type="hidden" name="room_type" value="suite">
<!--                        <button type="submit">Book Now</button>-->
        </form>
    </div>
    <br>
    <div class="Double">
<!--        <img src="../images/double.jpg" width="500">-->
        <h4>Double</h4>
        <p>The Classic Deluxe King Rooms are 504sqft/45sqm, and decorated in a timeless classic style blended with contemporary amenities. These rooms feature signature linens and featherbeds and pristine marble bathrooms, with double vanities, ESPA bath essentials and recessed TV. In-room comforts include interactive TV’s, fully stocked honour bar and Wi-Fi.</p>
        <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
            <input type="image" src="../images/double.jpg" alt="Submit" style="float:right" width="500">
            <input type="hidden" name="room_type" value="double">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>
    <div class="Twin">
        <img src="../images/twin.webp" width="500">
        <h4>Twin</h4>
        <p>The Classic Deluxe Twin Rooms feature two beds in a spacious 504sqft/45sqm. With elegant and timeless décor, these rooms provide maximum comfort with signature linens and featherbeds, and marble bathrooms with double vanities, rainforest showers and ESPA bath essentials. In-room amenities include fluffy bathrobes, interactive TV’s, complimentary newspaper and Wi-Fi.
            </p>
        <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
            <input type="hidden" name="room_type" value="twin">
            <button type="submit">Book Now</button>
        </form>
    </div>
    <br>

    <div class="Family">
        <img src="../images/family.jpg" width="500">
        <h4>Family</h4>
        <p>Classic Family Suites provide families an elevated level of comfort during their stay. With a total of 731sqft / 68sqm, these suites include a separate bedroom including two double beds, a large living area ideal to relax or entertain, featuring an interactive TV, complimentary newspaper and Wi-Fi. The marble bathrooms with double vanities are the perfect retreat after a busy day exploring the Estate, with rainforest showers, bath robes, recessed TV and ESPA bath essentials. Classic Family Suite is suitable for two adults and two children under twelve years of age.Children over twelve years of age are considered an adult.Children included on a room only or bed and breakfast basis only. Additional charges apply for childrens extras.</p>
        <form action="signInPrompt.php <?php $_SESSION['guestRedirect'] = "bookRoom.php"; ?>" method="post">
            <input type="hidden" name="room_type" value="family">
            <button type="submit">Book Now</button>
        </form>
    </div>

    <?php include "templates/footer.php"; ?>
