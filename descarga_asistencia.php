<?php
    session_start();
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "vigilante") {
        header("Location: ./login.php");
        exit();
    }
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

<div id="header-container">
    <?php require_once './contenido-descarga.php'?>
</div>

<?php
    require_once './template/footer.php';
?>