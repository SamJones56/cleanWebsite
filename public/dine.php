<?php include "templates/header.php"; ?>

    <title>Dine</title>

    <div class="container">

        <!-- Restaurant photos -->
        <div class="restaurant">
            <h2>Our Restaurant</h2>
            <img src="../images/img_rest/mainRestaurant.jpg" alt="Photo of main restaurant area" width="1000">
            <img src="../images/img_rest/barSeating.jpg" alt="Photo of bar seating area" width="1000">
        </div>


        <!-- Restaurant info -->
        <p>RESTAURANT INFO!!!</p>

        <!-- Menu images with links to pdf of menu -->
        <div class="menu">
            <h2>Our Menus</h2>
            <a href="../data/restaurant/breakfast.pdf" target="_blank"><img src="../images/png_menu/breakfast.png" alt="Breakfast Menu" width="300"></a>
            <a href="../data/restaurant/lunch.pdf" target="_blank"><img src="../images/png_menu/lunch.png" alt="Lunch Menu" width="300"></a>
            <a href="../data/restaurant/dinner.pdf" target="_blank"><img src="../images/png_menu/dinner.png" alt="Dinner Menu" width="300"></a>
        </div>

        <!-- Book button -->
        <!-- <a href="bookTable.php" class="book-btn">Book Now</a> -->
        <a href="bookTable.php">
<!--            <button style="font-size:32px; background-color:#54aeff; color:rgba(0,0,0,0.85); padding:10px; border:none; box-shadow: 0 2px 4px rgba(0,0,0,0.69);">-->
            <button>
                BOOK NOW

            </button>
        </a>

    </div>

<?php include "templates/footer.php"; ?>