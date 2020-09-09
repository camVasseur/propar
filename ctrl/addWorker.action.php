<?php

include_once "../modele/Personn.class.php";
include_once "../modele/AdminManager.class.php";
include_once "../modele/Worker.class.php";
session_start();

    $workerSurname = $_POST["workerSurname"];
    $workerName = $_POST["workerName"];
    $role = $_POST["role"];
    $worker = new Worker($workerSurname, $workerName, $role);
    var_dump($workerSurname);
    AdminManager::AddWorker($worker);
    echo json_encode($worker);
