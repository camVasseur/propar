<?php
session_start();
include_once "../modele/Worker.class.php";
include_once "../modele/AdminManager.class.php";


if(isset($_SESSION["userLogin"])){
    $login = $_SESSION["userLogin"];
    $worker = AdminManager::getWorker($login);
    echo json_encode($worker);
}
else{
    echo json_encode("NoUserLogged");
}
?>