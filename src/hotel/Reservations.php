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
        $this->employee->setEmployeeId($employee_id);
    }


    public function getCustomerId()
    {
        return $this->customer->getCustomerId();
    }

    public function setCustomerId($customer_id): void
    {
        $this->customer->setCustomerId($customer_id);
    }

    public function getReservationsId()
    {
        return $this->reservations_id;
    }

    public function setReservationsId($reservations_id): void
    {
        $this->reservations_id = $reservations_id;
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