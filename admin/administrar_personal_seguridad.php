<?php
    session_start();
    //si esta iniciado la sesion
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "admin") {
        header("Location: ../login.php");
        exit();
    }
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<?php 
    /*require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/PersonalSeguridadController.php";
    $userDatatableData = readDatatableVigilante();*/
    //$userData = readVigilante();
?>

<?php
    //include './template/header.php';
?>

<?php
    //include 'template/header.php';
    require_once './template/header.php'
?>
<?php
    require_once './template/sidebar.php'
?>
<?php
    require_once './template/topbar.php'
?>

<div id="header-container">
    <?php require_once './contenido-security.php'?>
</div>

<?php
    require_once './template/footer.php';
    //include './template/footer.php';
?>