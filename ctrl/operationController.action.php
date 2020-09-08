<?php
//methode getFinishOperation
//methode getOperationInProgress
//methode addOperation
// methode finishOperationByIdOperation
// methode qui liste les opérations en cours enfonction de l'id

include "../modele/OperationManager.class.php";



//Création d'un opération
$startDate = $_POST["starDate"];
$endDate = $_POST["endDate"];
$type = $_POST["type"];
$description = $_POST["description"];
$operation = new Operation($startDate, $endDate, $type, $description);
echo json_encode($description);

//Création d'un customer
$email = $_POST["email"];
$customerSurname = $_POST["customerSurname"];
$customerName = $_POST["customerName"];
$birthday = $_POST["birthday"];
$address = $_POST["address"];
$customer = new Customer($email, $customerName, $customerSurname, $birthday, $birthday);

//OperationManager::addOperation($operation, $customer);

//$operation = OperationManager::getOperationInProgress();


?>