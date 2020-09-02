<?php

include_once "../Singleton.class.php";
include "../Operation.class.php";
include "../OperationManager.class.php";
/*
$dbi = Singleton::getInstance()->getConnection();
$resultat = $dbi->query("SELECT * FROM customer ");
$arr = $resultat->fetchall();
var_dump($arr);

*/

 // test creation de l'objet Operation
$startDate = new DateTime('2020-08-01');
$endDate = new DateTime('2020-09-01');
$description = "blabla";
$type = "Petite";
$operation = new Operation($startDate, $endDate,$type,$description );

OperationManager::addOperation($operation);
