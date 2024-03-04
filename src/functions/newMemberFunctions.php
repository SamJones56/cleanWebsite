<?php


//use person\Member;
use person\Member;

function makeNewMember()
{
    if (isset($_POST['submit'])) {
        include "../src/functions/dataBaseFunctions.php";
        require "../common.php";
        require_once '../src/person/Member.php';

        // Create Member object
        $member = new Member();

        // Set user attributes
        $member->setName(escape($_POST['name']));
        $member->setAddress(escape($_POST['address']));
        $member->setPhNo(escape($_POST['ph_no']));
        $member->setDob(escape($_POST['dob']));

        // Add to user table
        addToTable($member->toUserArray(), "user");

        // Set customer attributes
        $member->setUserId(getKey("user", "user_id"));
        $member->setPassportNo(escape($_POST['passport_no']));

        // Add member attributes to customer table
        addToTable($member->toCustomerArray(), "customer");
        $member->setCustomerId(getKey("customer", "customer_id"));

        // Set login attributes
        $member->setLoginDetails(($_POST['email']), ($_POST['password']));

        // Add login table
        addToTable($member->toLoginArray(), "login");

        // Set login id
        $member->setLoginId(getKey("login", "login_id"));

        // Add to member table
        addToTable($member->toMemberArray(), "member");
    }
}