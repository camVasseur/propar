<?php


class Worker extends Personn
{
    public $role; //string
    public $password; //
    public $login;

    public function __construct($name, $surname, $role)
    {
        $this->role = $role;
        parent::__construct($name, $surname);
        $this->name = $name;
        $this->surname = $surname;
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