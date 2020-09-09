<?php
session_start();
include_once "../modele/Worker.class.php";


if(isset($_SESSION)){
    $user = $_SESSION["user"];
    if (isset($user)){
        echo json_encode($user);
    }
    else{
        echo null;
    }
}
else{
    echo null;
}
?>