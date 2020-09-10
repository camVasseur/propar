<?php

session_start();
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

$user = NULL;
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}


    if ($user != NULL) {
        $operations = OperationManager::inProgressOperationsByIdWorker($user);
        http_response_code(200);
        echo json_encode($operations);
    } else {
        $operations = OperationManager::getOperationInProgress();
        http_response_code(200);
        echo json_encode($operations);
    }

  ?>