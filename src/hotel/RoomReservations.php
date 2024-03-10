<?php


use hotel\Reservations;
use hotel\Room;

class RoomReservations extends Reservations
{
    protected $date, $check_id, $check_out, $total_price, $payment;
    // Create room object
    protected $room_id;

    public function __construct()
    {
         $this->room = new Room();
    }

    public function toRoomReservationsArray()
    {
        return array
        (
            //'reservations_id' => $this->reservations_id,
            'date' => $this->date,
            'check_in' => $this->check_id,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
            'payment' => $this->payment,
            'room_id' => $this->room_id,

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


//namespace hotel;
//
//
//class RoomReservations extends Reservations{
//    protected $date;
//        protected $check_in;
//            protected $check_out;
//                protected $total_price;
//                    protected $payment;
//
//
//    protected $room_id;
//
//    public function __construct()
//    {
//    }
//
//        public function toRoomReservationsArray()
//    {
//        return array
//        (
//            //'reservations_id' => $this->reservations_id->,
//            'date' => $this->date,
//            'check_in' => $this->check_in,
//            'check_out' => $this->check_out,
//            'total_price' => $this->total_price,
//            'payment' => $this->payment,
//            'room_id'=>$this->room_id,
//
//        );
//    }

//
//    public function getDate()
//    {
//        return $this->date;
//    }
//
//    public function setDate($date): void
//    {
//        $this->date = $date;
//    }
//
//
//    public function getCheckIn()
//    {
//        return $this->check_in;
//    }
//
//    public function setCheckIn($check_in): void
//    {
//        $this->check_in = $check_in;
//    }
//
//
//    public function getCheckOut()
//    {
//        return $this->check_out;
//    }
//
//
//    public function setCheckOut($check_out): void
//    {
//        $this->check_out = $check_out;
//    }
//
//
//    public function getTotalPrice()
//    {
//        return $this->total_price;
//    }
//
//    public function setTotalPrice($total_price): void
//    {
//        $this->total_price = $total_price;
//    }
//
//
//    public function getPayment()
//    {
//        return $this->payment;
//    }
//
//
//    public function setPayment($payment): void
//    {
//        $this->payment = $payment;
//    }
//
//
//    public function getRoomId()
//    {
//        return $this->room_id;
//    }
//
//
//    public function setRoomId($room_id): void
//    {
//        $this->room_id = $room_id;
//    }
//
//
//}
