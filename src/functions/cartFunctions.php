<?php
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';
function getRoomProducts($connection)
{
    $itemCount = getCount($connection, "extraoptions");
    $products = [];

    for($i = 0; $i < $itemCount['COUNT(*)']; $i++){
        $result = searchAllDB($connection, "extraoptions", "option_id", $i+1);
        if(!empty($result)) {
            $products[$i] = $result[0];
        }
    }

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

function displayProducts($connection)
{
    $products = getRoomProducts($connection);
//    require_once __DIR__ . '/../templates/list.php';
}

function displayCart($connection)
{
    $products = getRoomProducts($connection);
    $cartItems = getShoppingCart();
    header('Location: cart.php');
    if(!empty($cartItems)){
//    require_once __DIR__ . '/../templates/cart.php';
} else {
//    require_once __DIR__ . '/../templates/emptyCart.php';
}
}