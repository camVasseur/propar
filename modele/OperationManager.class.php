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
        $worker = self::getNextAvailableWorker();
        if($worker == NULL){
            return "Tous les workers sont occupés";
        }
        //on incremente le compteur Opération
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> query("select count(Id_Operation) 
                                        from operation");
        $count = $req->fetchColumn();
        $operation->setIdOperation($count +1);
        //On ajoute un customer
        self::addCustomer($customer);
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare('INSERT INTO `operation` (`Id_Operation`, `StartDate`, `EndDate`, `Description`
                                        , `Status`, `id_Operation_Type`, `Email`, `login`)    
                                        VALUES (:id, :startDate, :endDate, :des, :status, :operationTypeId, :email, :login)');
        $res = $req->execute(array(
            'id' => $operation->getIdOperation(),
            'startDate' => $operation->getStartDate()->format("Y-m-d"),
            'endDate' => $operation->getEndDate()->format("Y-m-d"),
            'des' => $operation->getDescription(),
            'status' => $operation->getStatus(),
            'operationTypeId' => strval($operation->getType()),
            'email' => $customer->getEmail(),
            'login' => strval($worker)
        ));
        return "opération ajoutée";
    }

    /** Ajoute un Customer à la Bdd
     * @param Customer $customer
     */
    public static function addCustomer(Customer $customer){
            $dbi = Singleton::getInstance()->getConnection();
            $req = $dbi->prepare('INSERT INTO `customer` (`Email`, `name`, `surname`, `birthday`, `adress`) 
                                        VALUES (:email, :nam , :surname, :birthday, :address)');
            $req->execute(array(
                'email' => $customer->getEmail(),
                'nam' => $customer->getName(),
                'surname' => $customer->getSurname(),
                'birthday' => $customer->getBirthday(),
                'address' => $customer->getAddress()
            ));

    }

    /** remplace le statut de en cours par finish une opération par l'id de l'opération
     *
     */
    public static function finishOperationByIdOperation($idOperation){
       $dbi = Singleton::getInstance()->getConnection();
       $req = $dbi -> prepare("UPDATE operation 
                                        SET Status = \"Finish\" 
                                        where Id_Operation =:idOpe");
       $req->execute(array(
           'idOpe'=>$idOperation
       ));
    }
    //toDo voir si c'est utile de faire cette fonction
    /*public static function finishOperationByNameCustomer(Customer $customer){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi -> prepare();
    }*/

    /** fonction qui retourne un array des opérations qui sont en cours par ordre alpha des clients
     *
     */
    public static function getOperationInProgress(){
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req =$dbi -> prepare("select login, Id_Operation, StartDate, EndDate, Description,Type_Operation,name, surname 
                                        from operation, operationtype, customer 
                                        where Status = 'En cours' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email order by name ASC");
//        $req =$dbi -> prepare("select StartDate, EndDate, Description,Type_Operation,name, surname
//                                        from operation, operationtype, customer
//                                        where Status = 'En cours' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email
//                                        order by name ASC");
        $req->execute(array());
        $arr = $req -> fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    /** fonction qui retourne un array des opérations qui sont finies par ordre alpha des clients
     *
     */
    public static function getFinishedOperation(){
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req =$dbi -> prepare("select login, Id_Operation, StartDate, EndDate, Description,Type_Operation,name, surname 
                                        from operation, operationtype, customer 
                                        where Status = 'Finish' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email 
                                        order by name");
        $req->execute(array());
        $arr = $req -> fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    public static function operationInProgressByIdWorker($login)
    {
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("select login, StartDate, EndDate, Description, Status,Type_Operation,name, surname 
                                            from operation, operationtype, customer 
                                        where login = :log 
                                        and Status = 'En cours' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email 
                                        order by name ASC");
        $req->execute(array(
            'log'=>$login
        ));
        $arr = $req -> fetchAll(PDO::FETCH_ASSOC);
        var_dump($arr);
    }
    /**Methode qui determine aléatoirement un worker disponible en fonction des règles métier
     * @return mixed|null
     */
    public static function getNextAvailableWorker(){
        //Requete sql qui permet d'avoir un tableau regroupant le login, le nombre d'operation par login et le role
       $dbi = Singleton::getInstance()->getConnection();
       $req = $dbi -> query("SELECT worker.login as login, count(operation.login) as nbAssignedOperation, role 
                                            from worker left join operation on operation.login= worker.login 
                                            where operation.Status = 'En cours'
                                            group by login, role");
       $res = $req->fetchAll(PDO::FETCH_ASSOC);

       //règle métier + création d'un tableau vide(logins) qui permet de mettre les workers disponibles et correspondant aux regles metiers
       if(isset($res)){
           $logins=array();
           foreach($res as $worker){

               if(($worker["role"] == "senior" and intval($worker["nbAssignedOperation"])<3)
                   or ($worker["role"] == "expert" and intval($worker["nbAssignedOperation"])<5)
                   or ($worker["role"] == "apprenti" and intval($worker["nbAssignedOperation"])<1)){
                    array_push($logins, $worker["login"]);
               }
           }
           //On fait un random des indexs du tableau login pour permettre d'attribuer aléatoirement une opération
           if(isset($logins)){

               $random = rand(0, (count($logins)-1));
               return $logins[$random];
           }
       }
       return NULL;
    } 
}