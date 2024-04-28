<?php

include "templates/header.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
include_once "../src/Functions/databasefunctions.php";
require_once '../src/DBconnect.php';

if ($_SESSION['permissionlvl'] < 2) {
    header("location:index.php");
}
$_SESSION['guestRedirect'] = "adminManageDiscounts.php";
$keys = ['discount_id', 'startDate', 'endDate', 'amount', 'description'];
$discountArray = buildTableList($connection, "discounts", "discount_id");

if (isset($_POST['submit_post'])) {
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateDiscount.php");
}
if (isset($_POST['delete_post'])) {
    $temp_id = $_POST['item_id'];
    deleteData($connection, "discounts", "discount_id", $temp_id);
    header("refresh:0");
}
?>
    <h2>Manage Discounts</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Discount id</th>
            <th scope="col">Start Month</th>
            <th scope="col">End Month</th>
            <th scope="col">Amount</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($discountArray as $disc) {
            printData($disc, "discount_id");
        } ?>
        </tbody>
    </table>
    <a href="createDiscount.php" class="btn btn-success"> Create a Discount </a>
    <a href="admin.php" class="btn btn-secondary"> Back to admin </a>
<?php
include_once "templates/footer.php";