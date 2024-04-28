<?php
// Shopping cart tutorial from moodle
// https://vle-bn.tudublin.ie/mod/resource/view.php?id=323519
include "templates/header.php";
include "../src/functions/newRoomReservation.php";
include   __DIR__ . "/../src/functions/cartFunctions.php";
require_once '../src/DBconnect.php';
//var_dump($_SESSION['temp_room_reservation']);
$total = $_SESSION['temp_room_reservation']['roomPrice'];


$products = getRoomProducts($connection);
$cartItems = getShoppingCart();


// try to find "action" in query-string variables
$action = filter_input(INPUT_GET, 'action');
switch ($action) {
    case 'cart':
        displayCart($connection);
        break;
    case 'addToCart':
        $id = filter_input(INPUT_GET, 'id');
        addItemToCart($id);
        displayCart($connection);
        break;
    case 'removeFromCart':
        $id = filter_input(INPUT_GET, 'id');
        removeItemFromCart($id);
        displayCart($connection);
        break;
    case 'changeCartQuantity':
        $id = filter_input(INPUT_GET, 'id');
        $amount = filter_input(INPUT_POST, 'amount');
        if ($amount == 'increase') {
            increaseCartQuantity($id);
        } else {
            reduceCartQuantity($id);
        }
        displayCart($connection);
        break;
    default:
        displayProducts($connection);
}


?>

<h2> Booking Details </h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Room Type</th>
        <th scope="col">Check in</th>
        <th scope="col">Check out</th>
        <th scope="col">Payment Type</th>
        <th scope="col">Room Cost</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $_SESSION['temp_room_type'] ?></td>
        <td><?php echo $_SESSION['temp_room_reservation']['check_in'] ?></td>
        <td><?php echo $_SESSION['temp_room_reservation']['check_out'] ?></td>
        <td><?php echo $_SESSION['temp_room_reservation']['payment'] ?></td>
        <td><?php echo $_SESSION['temp_room_reservation']['roomPrice'] ?></td>
    </tr>
    </tbody>
</table>

<br>

<br>

<h2> Room Additions</h2>

<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>

    <?php
    foreach($products as $id => $product):
        $price = number_format($product['price'], 2);
        ?>


        <div class="product col-md-3 text-center">
            <img src= "<?= $product['image'] ?>" alt="<?=
            $product['image'] ?>" width="200px">
            <?php //= starsHtml($product['stars']) ?>
            <h4><?= $product['name'] ?></h4>
            <div class="price">
                $ <?= $price ?>
                <form method="post" action="cart.php?action=addToCart&id=<?= $id
                ?>" style="display: inline">

                    <button class="btn btn-success">Add To
                        Cart</button>
                </form>
            </div>
            <?= $product['description'] ?>
        </div>


    <?php endforeach; ?>
        </tr>
        </thead>
    </table>
</div>



<?php if (isset($_SESSION['cart'])){?>
<h2> Your Cart </h2>
<div class="row">
    <div class="col font-weight-bold text-center">
        Image
    </div>
    <div class="col font-weight-bold">
        Item
    </div>
    <div class="col font-weight-bold text-right">
        Price
    </div>
    <div class="col font-weight-bold text-center">
        Quantity
    </div>
    <div class="col font-weight-bold text-right">
        Subtotal
    </div>
    <div class="col font-weight-bold">
        Action
    </div>
</div>

<?php
//    var_dump($cartItems);
//    var_dump($products);
foreach ($cartItems as $id => $quantity):
    $product = $products[$id];
    $price = $product['price'];
    $subtotal = $quantity * $price;
    // update total
    $total += $subtotal;
    // format prices to 2 d.p.
    $price = number_format($price, 2);
    $subtotal = number_format($subtotal, 2);
    ?>
    <div class="row border-top">
        <div class="col product text-center">
            <img src="<?= $product['image'] ?> "
                 alt="<?= $product['image'] ?>" width="300px>
        </div>
         <div class=" col">
            <h4><?= $product['name'] ?></h4>
            <?= $product['description'] ?>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $price ?>
        </div>
        <div class="col text-center align-self-center">
            <form action="cart.php?action=changeCartQuantity&id=<?= $id ?>"
                  method="post">
                <button type="submit" name="amount" value="reduce"
                        class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
                <?= $quantity ?>
                <button type="submit" name="amount" value="increase"
                        class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </form>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $subtotal ?>
        </div>
        <div class="col align-self-center">
            <form action="cart.php?action=removeFromCart&id=<?= $id ?>"
                  method="post">
                <button class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-remove"></span>
                    Remove
                </button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<?php } ?>
<br>
<div class="row border-top">
    <div class="col-10 price text-right">
        <?php
        $totalPost = number_format($total, 2);

        ?>
        $ <?= $totalPost ?>
    </div>
    <div class="col font-weight-bold ">
        Total
    </div>
</div>

<form method="post">
    <input type="submit" name="submit" value="Book" class="btn btn-success">

    <a href="bookroom.php" class="btn btn-secondary" >Back to room booking</a>
</form>


<?php
if (isset($_POST['submit'])) {
    newRoomReservation($connection, $_SESSION['temp_room_reservation'], $total, 1);
    addExtras($cartItems, $connection);
}
