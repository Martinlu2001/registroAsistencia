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

<!-- Titulo pagina inicio -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
</div>

<hr class="mt-0 mb-4">

<!-- Content Row -->
<div class="row">


</div>

<?php
    require_once './template/footer.php';
?>