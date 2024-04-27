<?php


namespace Tests\Unit;

use hotel\RestaurantTable;
use Tests\Support\UnitTester;

require_once 'src/hotel/RestaurantTable.php';
class RestaurantTableTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    function testGetSetTableID(){
        $table = new RestaurantTable();
        $table -> setTableId(1);
        $this->assertSame(1, $table->getTableId());

    }

    function testGetSetCapacity(){
        $table = new RestaurantTable();
        $table -> setCapacity(1);
        $this->assertSame(1, $table->getCapacity());
    }


}
