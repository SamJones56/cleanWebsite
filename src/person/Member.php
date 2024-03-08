<?php

namespace person;
use person\Login;

require_once 'Customer.php';
require_once 'Login.php';

class Member extends Customer
{
    protected $member_id, $login_id;
    private $permissionLvl = 1;
    // login object
    private $login;
    public function __construct() {
        // Initialize Login instance
        $this->login = new Login();
        // Set the permission lvl to 1 for lowest user
        $this->login->setPermissionlvl(1);
    }

    public function toMemberArray()
    {
        return array(
            'customer_id' => $this->customer_id,
            'login_id' => $this->login->getLoginId()
        );
    }

    public function toMemberFullArray()
    {
        return array(
            'member_id' => $this->member_id,
            'customer_id' => $this->customer_id,
            'login_id' => $this->login->getLoginId()
        );
    }

    public function setFilledMember($userArray)
    {
        $this->user_id = $userArray['user_id'];
        $this->name = $userArray['name'];
        $this->address = $userArray['address'];
        $this->ph_no = $userArray['ph_no'];
        $this->dob = $userArray['dob'];
        $this->customer_id = $userArray['customer_id'];
        $this->passport_no = $userArray['passport_no'];
        $this->login->setLoginId($userArray['Login_id']);
        $this->login->setEmail($userArray['email']);
        $this->login->setPassword($userArray['password']);
        $this->login->setPermissionlvl($userArray['permissionlvl']);
        $this->member_id = $userArray['member_id'];
    }

    public function getFilledMember()
    {
        return array(
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'ph_no' => $this->ph_no,
            'dob' => $this->dob,
            'customer_id' => $this->customer_id,
            'passport_no' => $this->passport_no,
            'login_id' => $this->login->getLoginId(),
            'email' => $this->login->getEmail(),
            'password' => $this->login->getPassword(),
            'permissionlvl' => $this->login->getPermissionlvl(),
            'member_id' => $this->member_id

        );
    }

    public function setLoginDetails($email, $password,$permissionlvl) {
        $this->login->setEmail($email);
        $this->login->setPassword($password);
        $this->login->setPermissionlvl($permissionlvl);
    }
    public function toLoginArray() {
        return $this->login->toLoginArray();
    }

    public function toLoginFullArray() {
        return $this->login->toLoginFullArray();
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

    public function setPermissionlvl($permissionlvl){
        $this->login->setPermissionlvl($permissionlvl);
    }

    public function getPermissionlvl(){
        return $this->login->getPermissionlvl();
    }
}