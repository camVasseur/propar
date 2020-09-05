<?php

include_once "Singleton.class.php";
class AdminManager
{
    public function __construct()
    {
    }

    /**Genere un mot de passe
     * @return string
     */
    public static function generatePassword(){
        $password = new DateTime('now');
        return $password->format("Gis");
    }

    /**Ajoute un worker à la base de donnée
     * @param Worker $worker
     */
    public static function AddWorker(Worker $worker){
        //genere password au prealable
        $password = self::generatePassword();
        $dbi = Singleton::getInstance()->getConnection();
        //on incremente le login de +1
        $req = $dbi -> query("select count(login) 
                                        from worker");
        $count = $req->fetchColumn();
        $worker->setLogin($count + 1);
        // on ajoute l'objet Worker à la Bdd
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi-> prepare("INSERT INTO worker (login, Name, Surname, Role, Password) 
                                        values (:log, :nam,:surnam, :role, :password)");
        $req->execute(array(
            'log'=>$worker->getLogin(),
            'nam'=>$worker->getName(),
            'surnam'=>$worker->getSurname(),
            'role'=>$worker->getRole(),
            'password'=>$password
        ));
    }

    /**Calcul du Ca à partir d'un tableau de prix
     * @return float|int
     */
    public static function calculCA(){
        $finishOperationPrice=self::getFinishOperationPrice();
        $cA=0;
        foreach($finishOperationPrice as $price){
            $cA= array_sum($finishOperationPrice);
        }
        return $cA;
    }

    /** permet d'avoir un tableau de prix concernant les operations terminée
     * @return array|null
     */
    public static function getFinishOperationPrice(){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->query("select Id_Operation, Status,Prix 
                                        from operation, operationtype 
                                        where operationtype.Id_Operation_Type=operation.id_Operation_Type");
        $res = $req->fetchAll();
        if(isset($res)){
            $finishOperationPrice = array();
            foreach($res as $operation){
                if($operation[1] == "Finish"){
                    array_push($finishOperationPrice, $operation[2]);
                }
            }
        }
        if(isset($finishOperationPrice)){

            return $finishOperationPrice;
        }
        return NULL;
}

    /**Fonction d'authentification qui détermine  si login et mdp ok return le role
     * @param $login
     * @param $password
     * @return mixed|null
     */
    public static function authentification($login, $password){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->query("select login, PASSWORD, role 
                                        from worker");
        $res =$req->fetchAll();
        if(isset($res)){
            foreach($res as $worker){
              if($worker[0] == $login and $worker[1] == $password){

                  return $worker[2];
              }  else{
                  return NULL;
              }
            }
        }
    }


}
