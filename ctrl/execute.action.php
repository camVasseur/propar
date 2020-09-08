<?php
include "../modele/Personn.class.php";
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
$operation = new Operation($startDate, $endDate,2,$description );
$customer = new Customer("dada.dodo@gmail.com", "Antoine", "Andre",$birthday,"20 rue des accacias");

$worker = new Worker("Dodo","Ddidi", "Expert" );

//if (filter_var($customer->getEmail(), FILTER_VALIDATE_EMAIL)) {



//$table = OperationManager::displayFinishoperation();
//print_r($table);
//OperationManager::numberOperationByWorker(1);
//OperationManager::addCustomer($customer);
//OperationManager::addOperation($operation, $customer);

//OperationManager::finishOperationByIdOperation(8);
//$auth = AdminManager::authentification("1","125440");
//var_dump($auth);

//OperationManager::addOperation($operation, $customer);
//AdminManager::AddWorker($worker);
//echo AdminManager::generatePassword();
//$finishTable=AdminManager::getFinishOperation();
//$ca=AdminManager::calculCA();
//echo $ca;
//}else {
 //return NULL;
//}