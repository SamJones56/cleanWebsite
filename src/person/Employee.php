<?php

namespace person;

use hotel\Department;

require_once 'User.php';
require_once 'Login.php';
require_once '../src/hotel/Department.php';

class Employee extends User
{
    protected $employee_id, $login_id, $dept_id, $job;
    // login and departments object
    private $login, $department;

    public function __construct() {
        // Initialize Login instance
        $this->login = new Login();
        $this->department = new Department();
    }

    public function toEmployeeArray(){
        return array(
            'user_id' => $this->getUserId(),
            'login_id' => $this->login->getLoginId(),
            'dept_id' => $this->department->getDeptId(),
            'job' => $this->job,
        );
    }

    public function setFilledEmployee($userArray)
    {
        $this->user_id = $userArray['user_id'];
        $this->name = $userArray['name'];
        $this->address = $userArray['address'];
        $this->ph_no = $userArray['ph_no'];
        $this->dob = $userArray['dob'];
        $this->login->setLoginId($userArray['Login_id']);
        $this->login->setEmail($userArray['email']);
        $this->login->setPassword($userArray['password']);
        $this->login->setPermissionlvl($userArray['permissionlvl']);
        $this->employee_id = $userArray['employee_id'];
        $this->department->setDeptId($userArray['dept_id']);
        $this->job=$userArray['job'];
    }

    public function getFilledEmployee()
    {
        return array(
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'ph_no' => $this->ph_no,
            'dob' => $this->dob,
            'login_id' => $this->login->getLoginId(),
            'email' => $this->login->getEmail(),
            'password' => $this->login->getPassword(),
            'permissionlvl' => $this->login->getPermissionlvl(),
            'dept_id' => $this->dept_id,
            'job' => $this->job,
            'employee_id' => $this->employee_id,
        );

    }
    public function setLoginDetails($email, $password,$permissionlvl) {
        $this->login->setEmail($email);
        $this->login->setPassword($password);
        $this->login->setPermissionlvl($permissionlvl);
    }

    public function toLoginArray() {
        return $this->login->toLoginArray();
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob($job)
    {
        $this->job = $job;
    }

    public function getLoginId()
    {
        return $this->login->getLoginId();
    }

    public function setLoginId($login_id)
    {
        $this->login->setLoginId($login_id);
    }

    public function getDeptId()
    {
        return $this->department->getDeptId();
    }

    public function setDeptId($dept_id)
    {
        $this->department->setDeptId($dept_id);
    }

    public function getPermissionlvl()
    {
        return $this->login->getPermissionlvl();
    }

    public function setPermissionlvl($permissionlvl)
    {
        $this->login->setPermissionlvl($permissionlvl);
    }

    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    public function setEmployeeId($employee_id): void
    {
        $this->employee_id = $employee_id;
    }
}