<?php
session_start();
include_once "../modele/AdminManager.class.php";

$action = $_POST["action"];

if ($action == "login"){
    login();
}

if ($action == "logout"){
    logout();
}


function login(){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $worker = AdminManager::authentification($login,$password);

    if ($worker != NULL){

        $_SESSION["user"] = $worker;

        http_response_code(200);
        echo json_encode($worker);
    }
    else{
        http_response_code(400);
        echo json_encode($_POST);
    }

}

function logout(){
    $_SESSION['user']=NULL;
    http_response_code(200);
    echo json_encode("ok");
}

?>


