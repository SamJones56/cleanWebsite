<?php
include "templates/header.php";
include "../src/functions/newRoomReservation.php";
require_once '../src/DBconnect.php';
//var_dump($_SESSION['temp_room_reservation']);
newRoomReservation($connection, $_SESSION['temp_room_reservation']);


// Create the products
$products = [];

$products['01'] = [
    'name' => 'Morning breakfast',
    'description' => 'book morning breakfast per day',
    'price' => '25',
    'image' => '../images/roomAdons/breakfast_trays.png'
];

$products['02'] = [
    'name' => 'Daily car rental',
    'description' => 'Book a 4 seater car per day',
    'price' => '100',
    'image' => '../images/roomAdons/hotel_car.png'
];

$products['03'] = [
    'name' => 'A round of golf',
    'description' => 'Book a round of gold',
    'price' => '50',
    'image' => '../images/roomAdons/hotel_golf.png'
];

$products['04'] = [
    'name' => 'Book a local tour',
    'description' => 'Book a local tour of Tallaght',
    'price' => '1000',
    'image' => '../images/roomAdons/hotel_tallaght.png'
];

?>

<h2> Booking Details </h2>
<table>
    <thead>
        <tr>
            <th>Room Type</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Payment Type</th>
            <th>Room Cost</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $_SESSION['temp_room_type']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['check_in']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['check_out']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['payment']?></td>
            <td><?php echo $_SESSION['temp_room_reservation']['roomPrice']?></td>
        </tr>
    </tbody>
</table>

<br>

<br>

<h2> Room Additions</h2>
<div class="row">
     <?php
    foreach($products as $id => $product):
        $price = number_format($product['price'], 2);
?>
        <div class="product col-md-2 text-center">
             <img src= "<?= $product['image'] ?>" alt="<?=
            $product['image'] ?>" width="300px">
<!--                --><?php //= starsHtml($product['stars']) ?>
                <h4><?= $product['name'] ?></h4>
            <div class="price">
                $ <?= $price ?>
                <form method="post" action="/?action=addToCart&id=<?= $id
                ?>" style="display: inline">
                    <button class="btn btn-primary btn-sm">Add To
                        Cart</button>
                </form>
            </div>
            <?= $product['description'] ?>
        </div>
    <?php endforeach; ?>
</div>

