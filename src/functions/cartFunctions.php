<?php
function getRoomProducts()
{
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

    return $products;
}

function getShoppingCart()
{
    // default is empty shopping cart array
    $cartItems = [];
    if (isset($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
    }
    return $cartItems;
}

function addItemToCart($id)
{
    $cartItems = getShoppingCart();
    $cartItems[$id] = 1;
    $_SESSION['cart'] = $cartItems;
}

function removeItemFromCart($id)
{
    $cartItems = getShoppingCart();
    unset($cartItems[$id]);
    $_SESSION['cart'] = $cartItems;
}

function getQuantity($id, $cart)
{
    if (isset($cart[$id])) {
        return $cart[$id];
    } else {
        return 0;
    }
}

function increaseCartQuantity($id)
{
    $cartItems = getShoppingCart();
    $quantity = getQuantity($id, $cartItems);
    $newQuantity = $quantity + 1;
    $cartItems[$id] = $newQuantity;
    $_SESSION['cart'] = $cartItems;
}

function reduceCartQuantity($id)
{
    $cartItems = getShoppingCart();
    $quantity = getQuantity($id, $cartItems);
    $newQuantity = $quantity - 1;
    if ($newQuantity < 1) {
        unset($cartItems[$id]);
    } else {
        $cartItems[$id] = $newQuantity;
    }
    $_SESSION['cart'] = $cartItems;
}

function displayProducts()
{
    $products = getRoomProducts();
//    require_once __DIR__ . '/../templates/list.php';
}

function displayCart()
{
    $products = getRoomProducts();
    $cartItems = getShoppingCart();
    if(!empty($cartItems)){
//    require_once __DIR__ . '/../templates/cart.php';
} else {
//    require_once __DIR__ . '/../templates/emptyCart.php';
}
}