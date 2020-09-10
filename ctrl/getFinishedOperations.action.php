<?php

session_start();
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";
include_once "../modele/AdminManager.class.php";
include_once "../modele/Worker.class.php";

$user = NULL;
if(isset($_SESSION["userLogin"])){
    $login = $_SESSION["userLogin"];
    $user = AdminManager::getWorker($login);
}



if ($user != NULL){
    $operations=OperationManager::finishedOperationsByIdWorker($login);
    http_response_code(200);
    echo json_encode($operations);
}
else{
    $operations=OperationManager::getFinishedOperation();
    http_response_code(200);
    echo json_encode($operations);
}

?>