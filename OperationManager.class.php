<?php
include_once "Singleton.class.php";

class OperationManager
{


    public function __construct()
    {

    }

    /** Ajoute une operation
     * @param Operation $operation
     * @param Customer $customer
     */

    public static function addOperation(Operation $operation, Customer $customer){

        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare('INSERT INTO `operation` (`Id_Operation`, `StartDate`, `EndDate`, `Description`
        , `Status`, `id_Operation_Type`, `id_Customer`, `login`) VALUES (:id, :startDate, :endDate, :des, :status, :operationTypeId, :customerId, :login)');
        $req->execute(array(
            'id' => $operation->getIdOperation(),
            'startDate' => $operation->getStartDate()->format("Y-m-d"),
            'endDate' => $operation->getEndDate()->format("Y-m-d"),
            'des' => $operation->getDescription(),
            'status' => $operation->getStatus(),
            'operationTypeId' => $operation->getType()->getIdType(),
            'customerId' => $customer->getIdCustomer(),
            'login' => 1//$login
        ));
    }

















}