<?php


class Customer extends  Personn
{

    public $birthday;
    public $address;
    public$email;

    public function __construct($email,$name,$surname, $birthday , $address)
    {
        $this->birthday = $birthday;
        $this->address = $address;
        $this->email =$email;

        parent::__construct($name, $surname);
            $this->name = $name;
            $this->surname = $surname;

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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