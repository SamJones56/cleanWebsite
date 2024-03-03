<?php

namespace person;

class Login
{
    protected $login_id, $email, $password;

    public function toLoginArray()
    {
        return array(
            'login_id' => $this->login_id,
            'email' => $this->email,
            'password' => $this->password
        );
    }

    public function getLoginId()
    {
        return $this->login_id;
    }

    public function setLoginId($login_id)
    {
        $this->login_id = $login_id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}