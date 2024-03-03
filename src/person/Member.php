<?php

namespace person;
use person\Login;

require_once 'Customer.php';
require_once 'Login.php';



class Member extends Customer
{
    protected $member_id, $login_id;
    // login object
    private $login;
    public function __construct() {
        // Initialize Login instance
        $this->login = new Login();
    }

    public function toMemberArray()
    {
        return array(
            'customer_id' => $this->customer_id,
            'login_id' => $this->login->getLoginId()
        );
    }

    public function setLoginDetails($email, $password) {
        $this->login->setEmail($email);
        $this->login->setPassword($password);
    }
    public function toLoginArray() {
        return $this->login->toLoginArray();
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }

    public function getLoginId()
    {
        return $this->login->getLoginId();
    }

    public function setLoginId($login_id)
    {
        $this->login->setLoginId($login_id);
    }
}