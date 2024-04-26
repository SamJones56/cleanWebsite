<?php

use person\Guest;

function makeNewGuest()
{
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/person/Guest.php';

        // Create Member object
        $guest = new Guest();

        // Set user attributes
        $guest->setName(escape($_POST['name']));
        $guest->setAddress(escape($_POST['address']));
        $guest->setPhNo(escape($_POST['ph_no']));
        $guest->setDob(escape($_POST['dob']));

        // Add to user table
        addToTable($connection, $guest->getUserArray(), "user");

        // Set customer attributes
        $guest->setUserId(getKey($connection, "user", "user_id"));
        $guest->setPassportNo(escape($_POST['passport_no']));

        // Add guest attributes to customer table
        addToTable($connection, $guest->toCustomerArray(), "customer");
        $guest->setCustomerId(getKey($connection, "customer", "customer_id"));

        // Add to guest table
        addToTable($connection, $guest->toGuestArray(), "guest");

        // Logg the guest in
        $_SESSION['isGuest'] = true;
        $_SESSION['isEmployee'] = false;
        $_SESSION['customer_id'] = $guest->getCustomerId();
        $_SESSION['permissionlvl'] = 0;
        header("location:" . $_SESSION['guestRedirect']);

    }
}