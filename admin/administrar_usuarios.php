<?php
    session_start();
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "admin") {
        header("Location: ../login.php");
        exit();
    }
?>

<?php 
    include './template/header.php';
?>
    <div id="holass">

    </div>
<?php 
    include './template/footer.php';
?>