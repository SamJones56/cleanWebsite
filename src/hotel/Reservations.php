<?php

namespace hotel;

use person\Customer;
use person\Employee;

require_once '../person/employee.php';
require_once '../person/customer.php';

class Reservations
{
    protected $reservations_id, $employee_id, $customer_id;
    // Staff and customer objects
    private $employee, $customer;

    public function __construct($staff, $customer)
    {
        $this->employee = new Employee();
        $this->customer = new Customer();
    }

    public function toReservationsArray()
    {
        return array
        (
            'employee_id' => $this->getEmployeeId(),
            'customer_id' => $this->getCustomerId()
        );
    }

   public function getEmployeeId()
   {
       return $this->employee->getEmployeeId();
   }

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