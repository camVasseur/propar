<?php

include_once "../Singleton.class.php";
include "../Operation.class.php";
include "../OperationManager.class.php";
include "../OperationType.class.php";
include "../Customer.class.php";
/*
$dbi = Singleton::getInstance()->getConnection();
$resultat = $dbi->query("SELECT * FROM operationType ");
$arr = $resultat->fetchall();
var_dump($arr);
*/


 // test creation de l'objet Operation
$startDate = new DateTime('2020-08-01');
$endDate = new DateTime('2020-09-01');
$description = "blabla";
$birthday =new DateTime('1990-09-01');
$operation = new Operation($startDate, $endDate,new OperationType("enorme", 15000000),$description );
$customer = new Customer("titi", "toto",$birthday ,"20 rue des Lilas");

OperationManager::addOperation($operation, $customer);
