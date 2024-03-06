<?php

//use person\Member;
use person\Member;

function updateNewMember()
{
    if (isset($_POST['submit']) && !$_SESSION('isEmployee')) {
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


        $member->setUserId(escape($_POST['dob']));
        $member->setPassportNo(escape($_POST['passport_no']));

    }
}