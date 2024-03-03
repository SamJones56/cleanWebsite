<?php


//use person\Member;
use person\Member;

function makeNewMember()
{
    if (isset($_POST['submit'])) {
        require "../common.php";
        include "../src/functions/dataBaseFunctions.php";
        require_once '../src/DBconnect.php';
        require_once '../src/person/Member.php';

        // Create Member object
        $member = new Member();

        // Set user attributes
        $member->setName(escape($_POST['name']));
        $member->setAddress(escape($_POST['address']));
        $member->setPhNo(escape($_POST['ph_no']));
        $member->setDob(escape($_POST['dob']));

        // Add to user table
        addToTable($connection, $member->toUserArray(), "user");

        // Set customer attributes
        $member->setUserId(getKey($connection, "user", "user_id"));
        $member->setPassportNo(escape($_POST['passport_no']));

        // Add member attributes to customer table
        addToTable($connection, $member->toCustomerArray(), "customer");
        $member->setCustomerId(getKey($connection, "customer", "customer_id"));

        // Set login attributes
        $member->setLoginDetails(($_POST['email']), ($_POST['password']));

        // Add login table
        addToTable($connection, $member->toLoginArray(), "login");

        // Set login id
        $member->setLoginId(getKey($connection, "login", "login_id"));

        // Add to member table
        addToTable($connection, $member->toMemberArray(), "member");
    }
}