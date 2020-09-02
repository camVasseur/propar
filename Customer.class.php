<?php


class Customer extends  Personn
{
    private $idCustomer;
    private static $count;
    private $birthday;
    private $adress;

    public function __construct($name,$surname, DateTime $birthday , $adress)
    {
        $this->birthday = $birthday;
        $this->adress = $adress;
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
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }


}