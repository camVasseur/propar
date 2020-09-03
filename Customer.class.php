<?php
include "Personn.class.php";

class Customer extends  Personn
{
    private $idCustomer;
    private static $count=20;
    private $birthday;
    private $address;

    public function __construct($name,$surname, DateTime $birthday , $address)
    {
        $this->birthday = $birthday;
        $this->address = $address;
        Customer::$count = Customer::$count + 1;
        $this->idCustomer = Customer::$count;
        parent::__construct($name, $surname);
            $this->name = $name;
            $this->surname = $surname;

    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public static function getCount()
    {
        return self::$count;
    }

    /**
     * @param mixed $count
     */
    public static function setCount($count)
    {
        self::$count = $count;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }


}