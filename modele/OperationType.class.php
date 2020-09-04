<?php


class OperationType
{
    private $type; //string
    private $idType; //int
    private static $count; //int
    private $price; //float

    public function __construct($type, $price){
        OperationType::$count = OperationType::$count + 1;
        $this->idType = OperationType::$count;
        $this->type = $type;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

}