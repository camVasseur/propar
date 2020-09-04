<?php
//include "Personn.class.php";

class Worker extends Personn
{
    private $role; //string
    private $password; //
    private $login;

    public function __construct($name, $surname, $role)
    {
        parent::__construct($name, $surname);
        $this->role = $role;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

}