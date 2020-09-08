<?php
//session_start();
include"../modele/AdminManager.class.php";
//recupère le formulaire par le call ajax
//Appel de la méthode qui verifie si l'authentification est ok return le role
//renvoie au vue du menu en fonction du métier
//$authentif= AdminManager::authentification(1,85233);
//echo $authentif;

//if( isset($_POST['login']) && isset($_POST['password']) ){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = AdminManager::authentification($login,$password);
    //echo json_encode($password);
    //return "Vous êtes connecté";
//    if($role == NULL){
//        http_response_code(400);
//    }else{
//
//        $_SESSION['role']=$role;
//       http_response_code(201);
//        echo json_encode($role);
//    }

//}
var_dump($login);


