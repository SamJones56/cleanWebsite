<?php
use hotel\Discount;
function makeDisount()
{
    // Form submitted
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/hotel/Discount.php';

        // Create new discount object
        $disc = new Discount();
        // Set department attributes
        $disc->setStartDate(escape($_POST['startDate']));
        $disc->setEndDate(escape($_POST['endDate']));
        $disc->setAmount(escape($_POST['amount']));

        // Add to department table
        addToTable($connection, $disc->getDiscountArray(), "discounts");
        // Set the id
        $disc->setDiscountId(getKey($connection, "discounts", "discount_id"));

        header("location:adminManageDepts.php");
    }
}

function updateDiscount($connection)
{
// Form submitted
    if (isset($_POST['submit'])) {
        require "../common.php";
        include_once "../src/functions/dataBaseFunctions.php";
        require_once '../src/hotel/Discount.php';

        // Create new discount object
        $disc = new Discount();
        // Set discount attributes
        $disc->setStartDate(escape($_POST['startDate']));
        $disc->setEndDate(escape($_POST['endDate']));
        $disc->setAmount(escape($_POST['amount']));
        // Update the table
        updateTable($connection, $disc->getDiscountArray(), "discounts", "discount_id", $disc->getdiscountId());
        // Redirect user
        header("location:" . $_SESSION['guestRedirect']);
    }
}