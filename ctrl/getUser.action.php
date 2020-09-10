<?php
session_start();
include_once "../modele/Worker.class.php";


if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    echo json_encode($user);
}
else{
    echo json_encode("NoUserLogged");
}
?>