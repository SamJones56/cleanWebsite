<?php
include_once "../src/functions/dataBaseFunctions.php";
require_once '../src/DBconnect.php';
// This function reads from the databse and returns the room products
function getRoomProducts($connection)
{
    // Get a count of all entries in the db
    $itemCount = getCount($connection, "extraoptions");
    // Loop through each entry
    for ($i = 0; $i < $itemCount['COUNT(*)']; $i++) {
        // search the database and return the result
        $result = searchAllDB($connection, "extraoptions", "option_id", $i + 1);
//        https://www.w3schools.com/php/func_var_empty.asp
        // Checking if it variable isn't empty
        if (!empty($result)) {
            // adds to the products array the result
            $products[$i] = $result[0];
        }
    }
    // Return the products array
    return $products;
}

// This function gets the current cart
function getShoppingCart()
{
    // default is empty shopping cart array
    $cartItems = [];
    // Check and see if cart is set for the session
    if (isset($_SESSION['cart'])) {
        // Build the cart items array from the sessions cart
        $cartItems = $_SESSION['cart'];
    }
    // Return the cart items
    return $cartItems;
}

// This function adds items to the cart taking in their id
function addItemToCart($id)
{
    // Get the current items
    $cartItems = getShoppingCart();
    // Set the id of the items
    $cartItems[$id] = 1;
    // Add the new items to the session cart
    $_SESSION['cart'] = $cartItems;
}

// This function removes an item from the cart
function removeItemFromCart($id)
{
    // Get the current cart
    $cartItems = getShoppingCart();
    // unset the selected id
    unset($cartItems[$id]);
    // update the session cart
    $_SESSION['cart'] = $cartItems;
}

// Get the quanitity of items
function getQuantity($id, $cart)
{
    // Check and see if an id is set
    if (isset($cart[$id])) {
        // Return the item at id
        return $cart[$id];
    } else {
        return 0;
    }
}

// Increase quantity of item in the cart
function increaseCartQuantity($id)
{
    // Get the current cart items
    $cartItems = getShoppingCart();
    // Get the quantity of the item
    $quantity = getQuantity($id, $cartItems);
    // Increase the quantity
    $newQuantity = $quantity + 1;
    // update the item at id
    $cartItems[$id] = $newQuantity;
    // update the session cart
    $_SESSION['cart'] = $cartItems;
}

// This function reduces the cart quantity
function reduceCartQuantity($id)
{
    // Get current cart
    $cartItems = getShoppingCart();
    // Get current quantity of item at id
    $quantity = getQuantity($id, $cartItems);
    // Decrement the id
    $newQuantity = $quantity - 1;
    // if the quantity is less than 1
    if ($newQuantity < 1) {
        // remove the item from the cart
        unset($cartItems[$id]);
    } else {
        // else update quantity
        $cartItems[$id] = $newQuantity;
    }
    // update session cart
    $_SESSION['cart'] = $cartItems;
}

// This function is used by the default to display the products
function displayProducts($connection)
{
    $products = getRoomProducts($connection);
}

// This function displays the cart
function displayCart($connection)
{
    // Get the products
    $products = getRoomProducts($connection);
    // Get the items in the cart
    $cartItems = getShoppingCart();
    // Redirect to the cart page
    header('Location: cart.php');
}