<?php

include_once "../Singleton.class.php";
include "../Operation.class.php";
include "../OperationManager.class.php";
include "../OperationType.class.php";
include "../Customer.class.php";
include "../Worker.class.php";

/*
$dbi = Singleton::getInstance()->getConnection();
$resultat = $dbi->query("SELECT * FROM operationType ");
$arr = $resultat->fetchall();
var_dump($arr);
*/


// test creation de l'objet Operation
//$startDate = new DateTime('2020-08-01');
//$endDate = new DateTime('2020-09-01');
//$description = "blabla";
//$birthday =new DateTime('1990-09-01');
//$operation = new Operation($startDate, $endDate,new OperationType("enorme", 15000000),$description );
//$customer = new Customer("tata", "tutu",$birthday ,"20 rue des acacias");

//$worker = new Worker("titi","toto", "expert" );
//OperationManager::operationInProgressByWorker(1);
OperationManager::numberOperationByWorker(1);
//OperationManager::addCustomer($customer);
//OperationManager::addOperation($operation, $customer);
//OperationManager::finishOperationByIdOperation($operation);
