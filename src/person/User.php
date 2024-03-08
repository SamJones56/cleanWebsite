<?php

namespace person;

use person\Login;

class User
{
    protected $user_id, $name, $dob, $address, $ph_no;

    public function toUserArray(){
        return array(
            'name' => $this->name,
            'address' => $this->address,
            'ph_no' => $this->ph_no,
            'dob' => $this->dob,
        );
    }

    public function toUserFullArray()
    {
        return array(
            'user_id'=>$this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'ph_no' => $this->ph_no,
            'dob' => $this->dob,
        );
    }
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPhNo()
    {
        return $this->ph_no;
    }

    public function setPhNo($ph_no)
    {
        $this->ph_no = $ph_no;
    }
}