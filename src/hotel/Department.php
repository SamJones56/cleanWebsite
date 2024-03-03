<?php

namespace hotel;

class Department
{
    protected $dept_id, $dept_name, $address;

    public function toDeptArray(){
        return array(
            'dept_name' => $this->dept_name,
            'address' => $this->address,
        );
    }

    public function getDeptId()
    {
        return $this->dept_id;
    }

    public function setDeptId($dept_id)
    {
        $this->dept_id = $dept_id;
    }

    public function getDeptName()
    {
        return $this->dept_name;
    }

    public function setDeptName($dept_name)
    {
        $this->dept_name = $dept_name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}