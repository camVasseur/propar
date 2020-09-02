<?php
include_once "Singleton.class.php";

class OperationManager
{


    public function __construct()
    {

    }

    public static function addOperation(Operation $operation){
        $dbi = Singleton::getInstance()->getConnection();
        $resultat = $dbi->prepare("Insert into Operation (Id_Operation, Description, Status) values (1,
            , 'blabla', 'en cours')");
        $arr = $resultat->fetchall();
        var_dump($arr);

     //creer l'objet Operation
        // Creer l'objet Customer
    // faire requete sql
    // Recuperer le type
    //  Ajouter à la bdd l'objet operation

    }

















}