<?php

namespace hotel;

use hotel\Reservations;
use hotel\Room;


class RoomReservations extends Reservations
{
    protected $date, $check_id, $check_out, $total_price, $payment;
    // Create room object
    private $room;

    public function __construct()
    {
        $this->room = new Room();
    }

    public function toRoomReservationArray()
    {
        return array
        (

        );
    }

    public function getRoomId()
    {
        return $this->room->getRoom_id();
    }

    public function setRoomId($room_id)
    {
        $this->room->setRoomId($room_id);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getCheckId()
    {
        return $this->check_id;
    }

    public function setCheckId($check_id): void
    {
        $this->check_id = $check_id;
    }

    public function getCheckOut()
    {
        return $this->check_out;
    }

    public function setCheckOut($check_out): void
    {
        $this->check_out = $check_out;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function setTotalPrice($total_price): void
    {
        $this->total_price = $total_price;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }


}