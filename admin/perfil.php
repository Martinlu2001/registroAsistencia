<?php
    session_start();
    
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "admin") {
        header("Location: ../login.php");
        exit();
    }
    /*ini_set('display_errors', 1);
    error_reporting(E_ALL);*/
?>

<?php 
    /*require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/PerfilAdminController.php";
    $userData = getPerfil($_SESSION["dniUser"]);*/
?>

<!-- <div id="header-container"> -->
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
<!-- </div> -->

<div id="head-container">
    <?php 
        require_once './contenido-perfil.php'
    ?>
</div>

<?php
    require_once './template/footer.php';
    //include 'template/footer.php';
?>