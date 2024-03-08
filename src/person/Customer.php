<?php

namespace person;

require_once 'User.php';

use person\Login;

class Customer extends User
{
    protected $customer_id, $passport_no;


    public function toCustomerArray()
    {
        return array (
            'user_id' => $this->getUserId(),
            'passport_no' => $this->passport_no
            );
    }

    public function toCustomerFullArray()
    {
        return array (
            'customer_id' => $this->customer_id,
            'user_id' => $this->getUserId(),
            'passport_no' => $this->passport_no
        );
    }
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }


    public function getPassportNo()
    {
        return $this->passport_no;
    }

    public function setPassportNo($passport_no)
    {
        $this->passport_no = $passport_no;
    }


}