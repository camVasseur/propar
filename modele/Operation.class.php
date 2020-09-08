<?php


class Operation
{
    public $idOperation; //int
    public $startDate; // DateTime
    public $endDate; //DateTime
    public $description; //String
    public $status = "" ; //String
    public $type; // Type

public function __construct(DateTime $startDate, DateTime $endDate, $type, $description){
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->description = $description;
    $this->type = $type;
    $this->status = "En cours";

}

    /**
     * @param int $idOperation
     */
    public function setIdOperation($idOperation)
    {
        $this->idOperation = $idOperation;
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