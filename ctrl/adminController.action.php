<?php
//methode calcul du ca
//methode creation du worker

include_once "../modele/Personn.class.php";
include_once "../modele/AdminManager.class.php";
include_once "../modele/Worker.class.php";
session_start();

//$workerSurname = $_SESSION["user"]["surname"];
//$workerName = $_SESSION["user"]["name"];
//$role = $_SESSION["user"]["role"];
$action= $_POST["action"];
if ($action == "getCa"){

    getCa();
}elseif($action == "addWorker") {
    newWorker();
}

    function newWorker()
    {
        $workerSurname = $_POST["workerSurname"];
        $workerName = $_POST["workerName"];
        $role = $_POST["role"];
        $worker = new Worker($workerSurname, $workerName, $role);
        var_dump($workerSurname);
        AdminManager::AddWorker($worker);
        echo json_encode($worker);
    }


function getCa()
{
    $ca = AdminManager::calculCA();
    echo json_encode($ca);


}