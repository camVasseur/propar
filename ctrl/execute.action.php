<?php

include_once "../modele/Singleton.class.php";
include "../modele/Operation.class.php";
include "../modele/OperationManager.class.php";
include "../modele/OperationType.class.php";
include "../modele/Customer.class.php";
include "../modele/Worker.class.php";
include "../modele/AdminManager.class.php";

/*
$dbi = Singleton::getInstance()->getConnection();
$resultat = $dbi->query("SELECT * FROM operationType ");
$arr = $resultat->fetchall();
var_dump($arr);
*/


// test creation de l'objet Operation
$startDate = new DateTime('2020-08-01');
$endDate = new DateTime('2020-09-01');
$description = "Je vais mettre des caractères spéciaux aujourd'hui";
$birthday =new DateTime('1990-09-01');
$operation = new Operation($startDate, $endDate,1,$description );
$customer = new Customer("tata", "élodie",$birthday ,"20 rue des acacias");

$worker = new Worker("d'uchemol","Théo", "Senior" );
//OperationManager::operationInProgressByWorker(1);
//OperationManager::numberOperationByWorker(1);
//OperationManager::addCustomer($customer);
//OperationManager::addOperation($operation, $customer);
//OperationManager::finishOperationByIdOperation(4);
//echo OperationManager::randomOperation();
//print_r(OperationManager::loginReplaceByRole(2));
//OperationManager::addOperation($operation, $customer);
AdminManager::AddWorker($worker);
//echo AdminManager::generatePassword();
//$finishTable=AdminManager::getFinishOperation();
//$ca=AdminManager::calculCA();
//echo $ca;