<?php
//methode getFinishOperation
//methode getOperationInProgress
//methode addOperation
// methode finishOperationByIdOperation
// methode qui liste les opérations en cours enfonction de l'id

include "../modele/OperationManager.class.php";
echo "toto";
$operation = OperationManager::getOperationInProgress();
echo json_encode($operation);

?>