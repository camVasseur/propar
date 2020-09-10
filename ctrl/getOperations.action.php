<?php
session_start();
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

$action = $_POST['action'];
$user = $_SESSION["user"];


if ($action == "listInProgress"){

    if ($user != NULL){
        $operations=OperationManager::inProgressOperationsByIdWorker($user['login']);
        http_response_code(200);
        echo json_encode($operations);
    }
    else{
        $operations=OperationManager::getOperationInProgress();
        http_response_code(200);
        echo json_encode($operations);
    }
}

if ($action == "listFinished"){

    if ($user != NULL){
        $operations=OperationManager::finishedOperationsByIdWorker($user['login']);
        http_response_code(200);
        echo json_encode($operations);
    }
    else{
        $operations=OperationManager::getFinishedOperation();
        http_response_code(200);
        echo json_encode($operations);
    }
}


?>