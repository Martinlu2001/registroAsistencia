<?php
    session_start();
    
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "vigilante") {
        header("Location: ./login.php");
        exit();
    }
?>

<?php 
    /*require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/PerfilAdminController.php";
    $userData = getPerfil($_SESSION["dniUser"]);*/
?>

<?php
    require_once './template/header.php'
?>

<?php
    require_once './template/sidebar.php'
?>

<?php
    require_once './template/topbar.php'
?>

<div id="head-container">
    <?php require_once './contenido-perfil.php'?>
</div>

<?php
    require_once './template/footer.php';
?>