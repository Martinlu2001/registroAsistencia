<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/Controller/PerfilController.php";
    $perfilController = new PerfilController($mysqli);
    $userData = $perfilController->getPerfil($_SESSION["dniUser"]);
?>

<?php
    $_SESSION["nameUser"] = $userData['nameVigilante'];
    $_SESSION["apelliUser"] = $userData['apelliVigilante'];
    if (isset($_SESSION["rolUser"]) && $_SESSION["rolUser"] == "vigilante") {
        $fullname = $_SESSION["nameUser"] .' '. $_SESSION["apelliUser"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <!-- Custom fonts for this template-->

    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <!-- fin sidebar -->
        <!-- Content Wrapper -->
        <!-- <div id="content-wrapper" class="d-flex flex-column"> -->

            <!-- Main Content -->
            <!-- <div id="content"> -->
                <!-- topbar -->
                
                 <!-- fin topbar -->

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid">                    -->