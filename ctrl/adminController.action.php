<?php
//methode calcul du ca
//methode creation du worker
include_once "../modele/Personn.class.php";
include_once "../modele/AdminManager.class.php";
include_once "../modele/Worker.class.php";


$workerSurname = $_POST["workerSurname"];
$workerName = $_POST["workerName"];
$role = $_POST["role"];
//echo json_encode($workerName);
//echo json_encode($workerSurname);
//echo json_encode($role);

$worker = new Worker($workerSurname, $workerName,$role);
AdminManager::AddWorker($worker);
echo json_encode($worker);



//var_dump($worker);