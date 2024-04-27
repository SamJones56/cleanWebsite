<?php
include "templates/header.php";
include_once "../src/Functions/editingRoomsAndTablesFunctions.php";
include_once "../src/Functions/databasefunctions.php";
require_once '../src/DBconnect.php';

if($_SESSION['permissionlvl'] < 2 )
{
    header("location:index.php");
}
$_SESSION['guestRedirect'] = "adminManageDiscounts.php";
$keys = ['discount_id', 'startDate', 'endDate', 'amount', 'description'];
$discountArray = buildTableList($connection, "discounts","discount_id");

if(isset($_POST['submit_post']))
{
    $_SESSION['tempEdit'] = $_POST['item_id'];
    header("Location: updateDiscount.php");
}
if(isset($_POST['delete_post'])){
    $temp_id = $_POST['item_id'];
    deleteData($connection, "discounts","discount_id",$temp_id);
    header("refresh:0");
}
?>
    <h2>Manage Discounts</h2>
    <button><a href="createDiscount.php" > Create a Discount </a> </button>
    <table>
        <thead>
        <tr>
            <th>Discount id</th>
            <th>Start Month</th>
            <th>End Month</th>
            <th>Amount</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($discountArray as $disc){
            printData($disc, "discount_id");
        }  ?>
        </tbody>
    </table>
    <a href="admin.php" > Back to admin </a>
<?php
include_once "templates/footer.php";