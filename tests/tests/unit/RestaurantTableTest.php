<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
use tests\unit\testerClasses\RestaurantTable;

require_once 'testerClasses/RestaurantTable.php';
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
