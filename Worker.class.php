<?php
//include "Personn.class.php";

class Worker extends Personn
{
    private $login; //int
    private static $count; //int
    private $role; //string
    private $password; //

    public function __construct($name, $surname, $role)
    {
        parent::__construct($name, $surname);
        $this->role = $role;
        Worker::$count = Worker::$count + 1;
        $this->login = Worker::$count;
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