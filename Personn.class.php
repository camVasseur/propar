<?php


class Personn
{
    protected $name;
    protected $surname;

    public function __construct($name, $surname){
        $this->name = $name;
        $this->surname = $surname;

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

}