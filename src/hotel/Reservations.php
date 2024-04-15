<?php

namespace hotel;

use person\Customer;
use person\Employee;

require_once '../src/person/Employee.php';
require_once '../src/person/Customer.php';

abstract class Reservations
{
    protected $reservations_id, $employee_id, $customer_id;
    // Staff and customer objects
    protected $employee, $customer;

    public function __construct()
    {
        $this->employee = new Employee();
        $this->customer = new Customer();
    }

    public function toReservationsArray()
    {
        return array
        (
            'employee_id' => $this->employee->getEmployeeId(),
            'customer_id' => $this->customer->getCustomerId()
        );
    }

    public function getEmployeeId()
    {
        return $this->employee->getEmployeeId();
    }

    //
    public function setEmployeeId($employee_id): void
    {
        if (is_numeric($employee_id)){
            $this->employee->setEmployeeId($employee_id);
        }
        else {
            echo "<br>";
            var_dump($employee_id);
            echo gettype($employee_id);
            echo "EmployeeId is not a number";
            echo "<br>";
        }
    }


    public function getCustomerId()
    {
        return $this->customer->getCustomerId();
    }

    public function setCustomerId($customer_id): void
    {
        if (is_numeric($customer_id)) {
            $this->customer->setCustomerId($customer_id);
        }
        else
        {
            echo "<br>";
            var_dump($customer_id);
            echo gettype($customer_id);
            echo "CustomerId is not a number";
            echo "<br>";
        }
    }

    public function getReservationsId()
    {
        return $this->reservations_id;
    }

    public function setReservationsId($reservations_id): void
    {
        if (is_numeric($reservations_id))
        {
            $this->reservations_id = $reservations_id;
        }
        else{
            echo "<br>";
            var_dump($reservations_id);
            echo gettype($reservations_id);
            echo "Reservations_id is not a number";
            echo "<br>";
        }
    }
}


//
//namespace hotel;
//
//
//class Reservations{
//
//    protected $reservations_id;
//    protected $staff_id;
//    protected $customer_id;
//
//
//    public function toReservationsArray()
//    {
//        return array
//        (
//            'reservations_id'=>$this->reservations_id,
//            'staff_id' => $this->staff_id,
//            'customer_id' => $this->customer_id
//        );
//    }
//
//
//    public function getReservationsId()
//    {
//        return $this->reservations_id;
//    }
//
//
//    public function setReservationsId($reservations_id): void
//    {
//        $this->reservations_id = $reservations_id;
//    }
//
//    public function getEmployeeId()
//    {
//        return $this->employee_id;
//    }
//
//
//    public function setEmployeeId($employee_id): void
//    {
//        $this->employee_id = $employee_id;
//    }
//
//    public function getCustomerId()
//    {
//        return $this->customer_id;
//    }
//
//
//    public function setCustomerId($customer_id): void
//    {
//        $this->customer_id = $customer_id;
//    }
//
//}