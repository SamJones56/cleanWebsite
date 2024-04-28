<?php

namespace Testing;


require_once "../../common.php";
require_once '../../src/DBconnect.php';
include "../../src/functions/dataBaseFunctions.php";


class SQLTester
{
    public function goodConnect()
    {
        $inputArray = array(
            'Login_id' => '03',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'permissionlvl' => '3'

        );
        addToTable($connection, $inputArray, "login");
    }
}