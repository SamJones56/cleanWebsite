<?php

namespace hotel;

use hotel\Reservations;
use hotel\Room;

require_once 'Reservations.php';
require_once 'Room.php';

final class RoomReservations extends Reservations
{
    protected $date, $check_in, $check_out, $total_price, $payment, $num_guests, $checked_in;
    // Create room object
    protected $room_id;
    // room object
    private $room;

    public function __construct()
    {
        parent::__construct();
        $this->room = new Room();
//         $checked_in = 0;
    }

    public function toRoomReservationsArray()
    {
        return array
        (
            'reservations_id' => $this->reservations_id,
            'date' => $this->date,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
            'payment' => $this->payment,
            'room_id' => $this->room_id,
            'num_guests' => $this->num_guests,
            'checked_in' => $this->checked_in
        );
    }

    public function setFilledRoomRes($resArray)
    {
        $this->reservations_id = $resArray['reservations_id'];
        $this->employee->setEmployeeId($resArray['employee_id']);
        $this->customer->setCustomerId($resArray['customer_id']);
        $this->date = $resArray['date'];
        $this->check_in = $resArray['check_in'];
        $this->check_out = $resArray['check_out'];
        $this->total_price = $resArray['total_price'];
        $this->payment = $resArray['payment'];
        $this->room_id = $resArray['room_id'];
        $this->num_guests = $resArray['num_guests'];
        $this->checked_in = $resArray['checked_in'];
    }

    public function getFilledRoomRes()
    {

        return array(
            'reservations_id' => $this->reservations_id,
            'employee_id' => $this->employee->getEmployeeId(),
            'customer_id' => $this->customer->getCustomerId(),
            'date' => $this->date,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
            'payment' => $this->payment,
            'room_id' => $this->room_id,
            'num_guests' => $this->num_guests,
            'checked_in' => $this->checked_in,
        );


    }


    public function getRoomId()
    {
        return $this->room_id;
    }

    public function setRoomId($room_id)
    {
        $this->room_id = $room_id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getCheckIn()
    {
        return $this->check_in;
    }

    public function setCheckIn($check_in): void
    {
        $this->check_in = $check_in;
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

    public function getNumGuests()
    {
        return $this->num_guests;
    }

    public function setNumGuests($num_guests): void
    {
        if ($num_guests > 0) {
            $this->num_guests = $num_guests;
        } else
            echo "<br> <h1> Number of guests must be greater than 0</h1>";
    }

    public function getCheckedIn()
    {
        return $this->checked_in;
    }

    public function setCheckedIn($checked_in): void
    {
        $this->checked_in = $checked_in;
    }
}

