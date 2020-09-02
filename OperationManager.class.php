<?php
include_once "Singleton.class.php";

class OperationManager
{


    public function __construct()
    {

    }

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

     //creer l'objet Operation
        // Creer l'objet Customer
    // faire requete sql
    // Recuperer le type
    //  Ajouter à la bdd l'objet operation

    }

















}