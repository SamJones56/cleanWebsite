<?php

namespace Tests\Unit;

use hotel\Department;
use Tests\Support\UnitTester;

require_once 'src/hotel/Department.php';
class DepartmentsTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    // Test toDeptArray method
    public function testToDeptArray(): void
    {
        $department = new Department();
        $department->setDeptName('Sales');
        $department->setAddress('123 Main St');

        $expected = [
            'dept_name' => 'Sales',
            'address' => '123 Main St',
        ];

        $this->assertSame($expected, $department->toDeptArray());
    }

    // Test getDeptId and setDeptId methods
    public function testGetSetDeptId(): void
    {
        $department = new Department();
        $department->setDeptId(1);

        $this->assertSame(1, $department->getDeptId());
    }

    // Test getDeptName and setDeptName methods
    public function testGetSetDeptName(): void
    {
        $department = new Department();
        $department->setDeptName('Sales');

        $this->assertSame('Sales', $department->getDeptName());
    }

    // Test getAddress and setAddress methods
    public function testGetSetAddress(): void
    {
        $department = new Department();
        $department->setAddress('123 Main St');

        $this->assertSame('123 Main St', $department->getAddress());
    }
}

