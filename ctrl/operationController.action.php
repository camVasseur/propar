<?php
//methode getFinishOperation
//methode getOperationInProgress
//methode addOperation
// methode finishOperationByIdOperation
// methode qui liste les opérations en cours enfonction de l'id
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

$action = $_POST['action'];

if ($action == "list"){

    $operations=OperationManager::getOperationInProgress();
    http_response_code(200);
    echo json_encode($operations);

}
else{
    //Création d'un opération

    $startDate = new DateTime($_POST["startDate"]);
//$startDate = $startDate->format('Y-m-d');
    $endDate = new DateTime($_POST["endDate"]);
    $type = $_POST["type"];
    $description = $_POST["description"];
//var_dump($startDate->format('Y-m-d'));
    $operation = new Operation($startDate, $endDate, $type, $description);

//Création d'un customer
    $email = $_POST["email"];
    $customerSurname = $_POST["customerSurname"];
    $customerName = $_POST["customerName"];
    $birthday = $_POST["birthday"];
    $address = $_POST["address"];
    $customer = new Customer($email, $customerName, $customerSurname, $birthday,$address);

    $op=OperationManager::addOperation($operation,$customer);
//echo json_encode($customer);

//$operation = OperationManager::getOperationInProgress();
    echo json_encode($op);
}



?>