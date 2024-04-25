<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
use person\Employee;
require_once 'src/person/Employee.php';
require_once 'src/hotel/Department.php';
class EmployeeTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testGetSetUserid(){
        $employee = new Employee();

        // Set properties using set methods or directly if they are public
        $employee->setUserId(1);
        $this->assertSame(1, $employee->getUserId());
    }
    public function testGetSetName(){
        $employee = new Employee();

        // Set properties using set methods or directly if they are public
        $employee->setName("EmployeeTester");
        $this->assertSame("EmployeeTester", $employee->getName());
    }
    public function testGetSetAddress(){
        $employee = new Employee();

        // Set properties using set methods or directly if they are public
        $employee->setAddress("I Live Here");
        $this->assertSame("I Live Here", $employee->getAddress());
    }

    public function testGetSetPhNo(){
        $employee = new Employee();

        $employee->setPhNo("000000000");
        $this->assertSame("000000000", $employee->getPhNo());
    }

    public function testGetSetDOB(){
        $employee = new Employee();

        $employee->setDob("08/11/95");
        $this->assertSame("08/11/95", $employee->getDob());
    }


    public function testGetSetLoginDetails(){
        $employee = new Employee();

        $employee->setLoginDetails('myemail@email.com', "password", 2);
        $expected = array('myemail@email.com', "password", 2);
        $this->assertSame($expected, $employee->getLoginDetails($employee));
    }

    public function testGetSetJob(){
        $employee = new Employee();

        $employee->setJob("Manager");
        $this->assertSame("Manager", $employee->getJob());
    }

    public function testGetSetEmployeeID(){
        $employee = new Employee();

        $employee->setEmployeeId(1);
        $this->assertSame(1, $employee->getEmployeeId());
    }

    public function testGetSetLoginID(){
        $employee = new Employee();

        $employee->setLoginId(1);
        $this->assertSame(1, $employee->getLoginId());
    }

    public function testGetFilledEmployee(): void
    {
        // Create a new Employee instance
        $employee = new Employee();

        // Set properties using set methods or directly if they are public
        $employee->setUserId(1);
        $employee->setName('Test Employee');
        $employee->setAddress('EmployeeLivesHere');
        $employee->setPhNo('0851234568');
        $employee->setDob('08/11/95');
        $employee->setLoginId(1000);
        $employee->setLoginDetails('myemail@email.com', "password", 2);
        $employee->setEmployeeId(3);
        $employee->setJob('Manager');

        // Expected array after calling getEmployeeArray method
        $expected = [

            'user_id' => 1,
            'name' => 'Test Employee',
            'address' => 'EmployeeLivesHere',
            'ph_no' => '0851234568',
            'dob' => '08/11/95',
            'login_id' => 1000,
            'email' => 'myemail@email.com',
            'password' =>"password",
            'permissionlvl' =>2,
            'dept_id' => null,
            'job' => 'Manager',
            'employee_id' => 3,
        ];

        $this->assertEquals($expected, $employee->getFilledEmployee());
    }

}
