<?php

namespace person;

require_once 'Customer.php';
//require_once 'Login.php';

class Guest extends Customer
{
    protected $guest_id;

//    private $login;

    public function __construct(){
//        $this->login = new Login();
//        // Set the permission lvl to 1 for lowest user
//        $this->login->setPermissionlvl(0);
//        $this->login->setEmail("guestEmail" . $this->login->getLoginId() . "com");
//        $this->login->setPassword($this->login->getLoginId());
    }

    public function toGuestArray()
    {
        return array(
            'customer_id' => $this->customer_id,
        );
    }
    public function setFilledGuest($userArray){
        $this->user_id = $userArray['user_id'];
        $this->name = $userArray['name'];
        $this->address = $userArray['address'];
        $this->ph_no = $userArray['ph_no'];
        $this->dob = $userArray['dob'];
        $this->customer_id = $userArray['customer_id'];
        $this->passport_no = $userArray['passport_no'];
//        $this->login->setLoginId($userArray['Login_id']);
//        $this->login->setEmail($userArray['email']);
//        $this->login->setPassword($userArray['password']);
//        $this->login->setPermissionlvl($userArray['permissionlvl']);
        $this->guest_id = $userArray['guest_id'];
    }

    public function getFilledGuest()
    {
        return array(
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'ph_no' => $this->ph_no,
            'dob' => $this->dob,
            'customer_id' => $this->customer_id,
            'passport_no' => $this->passport_no,
//            'login_id' => $this->login->getLoginId(),
//            'email' => $this->login->getEmail(),
//            'password' => $this->login->getPassword(),
//            'permissionlvl' => $this->login->getPermissionlvl(),
            'guest_id' => $this->guest_id
        );
    }

//    public function setLoginDetails($email, $password,$permissionlvl) {
//        $this->login->setEmail($email);
//        $this->login->setPassword($password);
//        $this->login->setPermissionlvl($permissionlvl);
//    }

    public function getLoginDetails()
    {

    }

//    public function toLoginArray() {
//        return $this->login->toLoginArray();
//    }

//    public function toLoginFullArray() {
//        return $this->login->toLoginFullArray();
//    }

    public function getMemberId()
    {
        return $this->guest_id;
    }

    public function setMemberId($member_id)
    {
        $this->guest_id = $member_id;
    }

//    public function getLoginId()
//    {
//        return $this->login->getLoginId();
//    }

//    public function setLoginId($login_id)
//    {
//        $this->login->setLoginId($login_id);
//    }

//    public function setPermissionlvl($permissionlvl){
//        $this->login->setPermissionlvl($permissionlvl);
//    }

//    public function getPermissionlvl(){
//        return $this->login->getPermissionlvl();
//    }
}