<?php

include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

$action = $_POST['action'];

if ($action == "listInProgress"){

    $operations=OperationManager::getOperationInProgress();
    http_response_code(200);
    echo json_encode($operations);

//}elseif ($action == "listFinish"){
//    $operations=OperationManager::getFinishoperation();
//    http_response_code(200);
//    echo json_encode($operations);
}

if ($action == "listFinished"){

    $operations=OperationManager::getFinishedOperation();
    http_response_code(200);
    echo json_encode($operations);

//}elseif ($action == "listFinish"){
//    $operations=OperationManager::getFinishoperation();
//    http_response_code(200);
//    echo json_encode($operations);
}

if ($action == "listByWorker"){

    $operations=OperationManager::getOperationInProgress();
    http_response_code(200);
    echo json_encode($operations);

//}elseif ($action == "listFinish"){
//    $operations=OperationManager::getFinishoperation();
//    http_response_code(200);
//    echo json_encode($operations);
}

?>