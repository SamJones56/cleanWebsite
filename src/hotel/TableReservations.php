<?php

namespace hotel;

use hotel\Reservations;
use hotel\RestaurantTable;
final class TableReservations extends Reservations
{
    protected $date, $time, $no_guests;
    private $restaurantTable;

    public function __construct()
    {
        $this->restaurantTable = new RestaurantTable();
    }

    public function getRestaurantTableId(){
        return $this->restaurantTable-$this->getRestaurantTableId();
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