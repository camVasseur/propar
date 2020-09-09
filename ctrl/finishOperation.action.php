<?php
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

session_start();
$idOperation = $_POST['idOperation'];
$finishOperation = OperationManager::finishOperationByIdOperation($idOperation);
echo json_encode($finishOperation);