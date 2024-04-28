<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
use tests\unit\testerClasses\RoomReservations;

require_once 'testerClasses/RoomReservations.php';

class RoomReservationTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    function testGetSetRoomID(){
        $roomReservation = new RoomReservations();
        $roomReservation->setRoomId(1);
        $this->assertSame(1,$roomReservation->getRoomId());

    }

    function testGetSetDate(){
        $roomReservation = new RoomReservations();
        $roomReservation->setDate('01/01/2023');
        $this->assertSame('01/01/2023',$roomReservation->getDate());

    }
    function testGetSetCheckIn(){
        $roomReservation = new RoomReservations();
        $roomReservation->setCheckIn('01/01/2023');
        $this->assertSame('01/01/2023',$roomReservation->getCheckIn());

    }
    function testGetSetCheckOut(){
        $roomReservation = new RoomReservations();
        $roomReservation->setCheckOut('01/01/2023');
        $this->assertSame('01/01/2023',$roomReservation->getCheckOut());

    }
    function testGetSetTotalPrice(){
        $roomReservation = new RoomReservations();
        $roomReservation->setTotalPrice(400);
        $this->assertSame(400,$roomReservation->getTotalPrice());

    }
    function testGetSetPayment(){
        $roomReservation = new RoomReservations();
        $roomReservation->setPayment('card');
        $this->assertSame('card',$roomReservation->getPayment());

    }
    function testGetSetNumGuests(){
        $roomReservation = new RoomReservations();
        $roomReservation->setNumGuests(2);
        $this->assertSame(2,$roomReservation->getNumGuests());

    }
    function testGetSetCheckedIn(){
        $roomReservation = new RoomReservations();
        $roomReservation->setCheckedIn(0);
        $this->assertSame(0,$roomReservation->getCheckedIn());

    }

    function testGetSetFilledRoomRes(){
        $roomReservation = new RoomReservations();
        $roomRes = array(
            'reservations_id' => 1,
            'employee_id'=> 1,
            'customer_id' => 1,
            'date' => '01/02/2022',
            'check_in' => '01/02/2022',
            'check_out' => '04/02/2022',
            'total_price' =>400,
            'payment' => 'card',
            'room_id' => 1,
            'num_guests' =>2,
            'checked_in' =>1,
        );

        $roomReservation->setFilledRoomRes($roomRes);

        $expected = [
            'reservations_id' => 1,
            'employee_id'=> 1,
            'customer_id' => 1,
            'date' => '01/02/2022',
            'check_in' => '01/02/2022',
            'check_out' => '04/02/2022',
            'total_price' =>400,
            'payment' => 'card',
            'room_id' => 1,
            'num_guests' =>2,
            'checked_in' =>1,
        ];

        $this->assertEquals($expected, $roomReservation->getFilledRoomRes());
    }
}
