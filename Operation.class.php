<?php


class Operation
{
    private $idOperation; //int
    private static $count = 0; //variable statique permettant d'incrementer
    private $startDate; // DateTime
    private $endDate; //DateTime
    private $description; //String
    private $status = "" ; //String
    private $type; //

public function __construct(DateTime $startDate, DateTime $endDate,$type, $description){
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->description = $description;
    Operation::$count = Operation::$count + 1;
    $this->idOperation = Operation::$count;
    $this->type = $type;
    $this->status = "En cours";

}


}