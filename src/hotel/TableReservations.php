<?php

namespace hotel;

use hotel\Reservations;
use hotel\RestaurantTable;

require_once 'Reservations.php';
require_once 'RestaurantTable.php';

final class TableReservations extends Reservations
{
    protected $date, $time, $no_guests;

    protected $table_id;
    private $restaurantTable;

    public function __construct()
    {
        parent::__construct();
        $this->restaurantTable = new RestaurantTable();
    }

    public function toTableReservationsArray()
    {
        return array
        (
            'reservations_id' => $this->reservations_id,
            'date' => $this->date,
            'time' => $this->time,
            'no_guests' => $this->no_guests,
            'table_id' => $this->getRestaurantTableId()
        );
    }

    public function setFilledTableRes($resArray)
    {
        $this->reservations_id = $resArray['reservations_id'];
        $this->employee->setEmployeeId($resArray['employee_id']);
        $this->customer->setCustomerId($resArray['customer_id']);
        $this->date = $resArray['date'];
        $this->time = $resArray['time'];
        $this->no_guests = $resArray['no_guests'];
        $this->restaurantTable->setTableId($resArray['table_id']);
    }


    public function getRestaurantTableId(){
        return $this->restaurantTable->getTableId();
    }

    public function setRestaurantTableId($table_id)
    {
        $this->restaurantTable->setTableId($table_id);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time): void
    {
        $this->time = $time;
    }

    public function getNoGuests()
    {
        return $this->no_guests;
    }

    public function setNoGuests($no_guests): void
    {
        $this->no_guests = $no_guests;
    }
}