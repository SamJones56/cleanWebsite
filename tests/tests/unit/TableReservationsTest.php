<?php


namespace Tests\Unit;

use hotel\TableReservations;
use Tests\Support\UnitTester;

require_once 'src/hotel/TableReservations.php';
class TableReservationsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    function testGetSetRestaurantTableID(){
        $tableRes = new TableReservations();
        $tableRes->setRestaurantTableId(1);

        $this->assertSame(1, $tableRes->getRestaurantTableId());
    }

    // tests
    public function testSomeFeature()
    {

    }
}
