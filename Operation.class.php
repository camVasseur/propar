<?php


class Operation
{
    private $idOperation; //int
    private static $count = 29; //variable statique permettant d'incrementer
    private $startDate; // DateTime
    private $endDate; //DateTime
    private $description; //String
    private $status = "" ; //String
    private $type; // Type

public function __construct(DateTime $startDate, DateTime $endDate, $type, $description){
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->description = $description;
    Operation::$count = Operation::$count + 1;
    $this->idOperation = Operation::$count;
    $this->type = $type;
    $this->status = "En cours";

}

    /**
     * @return int
     */
    public function getIdOperation()
    {
        return $this->idOperation;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }






}