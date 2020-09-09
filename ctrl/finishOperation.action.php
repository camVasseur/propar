<?php
include_once "../modele/Personn.class.php";
include_once "../modele/Operation.class.php";
include_once "../modele/Customer.class.php";
include_once "../modele/OperationManager.class.php";

$idOperation =  $_POST['idOperation'];
OperationManager::finishOperationByIdOperation($idOperation);
echo json_encode("ok");