<?php


namespace Tests\Unit;

use person\Login;
use Tests\Support\UnitTester;

require_once 'src/person/Login.php';
class LoginTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    function testGetSetLoginId(){
        $login = new Login();
        $login->setLoginId(1);
        $this->assertSame(1, $login->getLoginId());
    }
    function testGetSetEmail(){
        $login = new Login();
        $login->setEmail('myemail@email.com');
        $this->assertSame('myemail@email.com', $login->getEmail());
    }
    function testGetSetPassword(){
        $login = new Login();
        $login->setPassword('password');
        $this->assertSame('password', $login->getPassword());
    }
    function testGetSetPermissionLvl(){
        $login = new Login();
        $login->setPermissionlvl(1);
        $this->assertSame(1, $login->getPermissionlvl());
    }




}
