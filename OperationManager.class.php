<?php
include_once "Singleton.class.php";

class OperationManager
{


    public function __construct()
    {

    }

<<<<<<< HEAD
    public static function addOperation(Operation $operation){


  /* $dbi = Singleton::getInstance()->getConnection();
        $resultat = $dbi->query("SELECT * FROM operation");
    $arr = $resultat->fetchall();
    var_dump($arr);*/
        $dbi = Singleton::getInstance()->getConnection();
        $resultat = $dbi->prepare("Insert into operation (Id_Operation, Description, Status) values (1,
            , 'blabla', 'en cours')");
        $arr = $resultat->fetchall(PDO::Id_Operation);
        var_dump($arr);
=======
    /** Ajoute une operation
     * @param Operation $operation
     * @param Customer $customer
     */
>>>>>>> 2f3e64c8bee7e33476565e3e001cddec80fdc50d

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
            'login' => //$login
        ));
    }

















}