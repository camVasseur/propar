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

    /**Ajoute un worket à la base de donnée
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
}
