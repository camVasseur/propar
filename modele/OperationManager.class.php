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
        $req = $dbi -> query("select count(id_Operation) 
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
        $req->execute(array(
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
                'birthday' => $customer->getBirthday()->format("Y-m-d"),
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
        $req =$dbi -> prepare("select login, StartDate, EndDate, Description, Status,Type_Operation,name, surname 
                                        from operation, operationtype, customer 
                                        where Status = 'En cours' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email 
                                        order by name ASC");
        $req->execute(array());
        $arr = $req -> fetchAll();
        var_dump($arr);
    }

    /** fonction qui retourne un array des opérations qui sont finies par ordre alpha des clients
     *
     */
    public static function getFinishoperation(){
        //$login = $_SESSION["login"];
        $dbi = Singleton::getInstance()->getConnection();
        $req =$dbi -> prepare("select login, StartDate, EndDate, Description, Status,Type_Operation,name, surname 
                                        from operation, operationtype, customer 
                                        where Status = 'Finish' and operationtype.Id_Operation_Type=operation.id_Operation_Type and operation.Email=customer.Email 
                                        order by name ASC");
        $req->execute(array());
        $arr = $req -> fetchAll();
        var_dump($arr);
    }

    /**Methode qui determine aléatoirement un worker disponible en fonction des règles métier
     * @return mixed|null
     */
    public static function getNextAvailableWorker(){
        //Requete sql qui permet d'avoir un tableau regroupant le login, le nombre d'operation par login et le role
       $dbi = Singleton::getInstance()->getConnection();
       $req = $dbi -> query("SELECT worker.login, count(operation.login) as nombre_worker, role 
                                            from worker left join operation on operation.login= worker.login 
                                            group by login, role");
       $res = $req->fetchAll();
       //règle métier + création d'un tableau vide(logins) qui permet de mettre les workers disponibles et correspondant aux regles metiers
       if(isset($res)){
           $logins=array();
           foreach($res as $worker){
               if(($worker[2] == "Senior" and $worker[1]<3) or ($worker[2] == "Expert" and $worker[1]<5) or ($worker[2] == "Apprenti" and $worker[1]<1)){
                    array_push($logins, $worker[0]);
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