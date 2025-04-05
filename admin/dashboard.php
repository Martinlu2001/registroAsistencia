<?php
    session_start();
    //si esta iniciado la sesion
    /*if(!isset($_SESSION['idUsuario'])){
        header("Location: login.php");
    }*/
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "admin") {
        header("Location: ../login.php");
        exit();
    }
?>

<?php 
    include './template/header.php';
?>

<?php 
    include './template/footer.php';
?>