<?php
require_once '../src/DBconnect.php';
require_once "../src/functions/newRoomReservation.php";
include_once "../src/functions/dataBaseFunctions.php";

function tester($connection, $chk_in, $chk_out)
{
    $tempArray = roomPriceCalculator($connection, 120, $chk_in, $chk_out);
    return $tempArray;
}

// Test 2 - Fails to find discounts (would require dropping from the table)
$chk_in = strtotime("2024-04-02 00:00:00.00");
$chk_out = strtotime("2024-04-05 00:00:00.00");
$result = tester($connection, $chk_in, $chk_out);

echo '<h1>Test 2</h1> <h3>' . $result . '</h3> <br>';

// Test 1 - Works
$discArray = array(
    'discount_id' => "1",
    'startDate' => '2024-04-01',
    'endDate' => '2024-05-30',
    'amount' => "0.90",
    'description' => 'Test Deal');

addToTable($connection, $discArray, "discounts");

$result = tester($connection, $chk_in, $chk_out);
echo '<h1>Test 1</h1> <h3>' . $result . '</h3> <br>';

// Test 3 - Discount found, but no dates
$chk_in = strtotime("");
$chk_out = strtotime("");
$result = tester($connection, $chk_in, $chk_out);
echo '<h1>Test 3</h1> <h3>' . $result . '</h3> <br>';

// Test 4 - Discount found, Dates found, but no discount aplied
$chk_in = strtotime("2025-01-02");
$chk_out = strtotime("2025-01-05");
$result = tester($connection, $chk_in, $chk_out);
echo '<h1>Test 4</h1> <h3>' . $result . '</h3> <br>';