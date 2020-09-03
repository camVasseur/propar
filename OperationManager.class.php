<?php
include_once "Singleton.class.php";

class OperationManager
{


    public function __construct()
    {

    }

    /** Ajoute une operation à la Bdd
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

    /** Ajoute un Customer à la Bdd
     * @param Customer $customer
     */
    public static function addCustomer(Customer $customer){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> prepare('INSERT INTO `customer` (`id_Customer`, `name`, `surname`, `birthday`, `adress`) 
        VALUES (:id, :nam , :surname, :birthday, :address)');
        $req->execute(array(
            'id'=> $customer->getIdCustomer(),
            'nam' => $customer->getName(),
            'surname' => $customer->getSurname(),
            'birthday' => $customer->getBirthday()->format("Y-m-d"),
            'address' => $customer->getAddress()
        ));
    }

    /** Supprime une opération par l'id de l'opération
     * @param Operation $operation
     */
    public static function finishOperationByIdOperation(Operation $operation){
       $dbi = Singleton::getInstance()->getConnection();
       $req = $dbi -> prepare("DELETE FROM operation WHERE Id_Operation = :idOperation");
       $req->execute(array(
           'idOperation'=>$operation->getIdOperation()
       ));
    }
    //toDo voir si c'est utile de faire cette fonction
    /*public static function finishOperationByNameCustomer(Customer $customer){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> prepare();
    }*/

    /** fonction qui retourne un array des opérations qui sont en cours par login
     * @param $login
     */
    public static function operationInProgressByIdWorker($login){
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req =$dbi -> prepare("select * from operation where login = :log  and Status = \"en cours\"");
        $req->execute(array(
            'log'=>$login
        ));
        $arr = $req -> fetchAll();
        var_dump($arr);
    }

    /**Methode qui compte le nombre d'opération en fonction du worker
     * @param $login
     *
     */
    public static function numberOperationByWorker($login){
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> prepare("select login from operation where login= :log");
        $req-> execute(array(
            'log' => $login
        ));
        $arr = $req -> rowCount();
        //var_dump($arr);
    }

    /**Methode privée qui tire au sort aléatoirement un worker
     * @return int
     */
   public static function randomOperation(){
        //determination du nombre de worker
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> query("select count(login) from worker");
        $req = $req->fetchColumn();

        //tire au sort un Worker
        return rand(1,$req);
    }

    /**methode qui remplace le login par le role du worker
     * return un un array
     */
    public static function loginReplaceByRole($login){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> prepare("select Role from worker where login = :log");
        $req ->execute(array(
            'log'=>$login
        ));
        $arr = $req -> fetchAll();
        return $arr;
    }

    public static function attrubuteOperation($role, $operationNumber){

        // Si worker est apprenti et operation < 1
         if $role ==    
        // Si worker est senior et operation < 3
        // Si worker est Expert et operation <5
    }





















}