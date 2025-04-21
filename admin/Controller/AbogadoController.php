<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/admin/Model/AbogadoModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    $userLawyer = new AbogadoModel($mysqli);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "create") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $gender = $_POST['gender'];

        $createLawyer = $userLawyer->createAbogado($dni, $name, $lastname, $phone, $rol, $gender);

        if ($createLawyer) {
            echo json_encode(['status' => 'success', 'message' => 'Abogado registrado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar abogado']);
        }
    }

    function readDatatableAbogado(){
        global $userLawyer;
        return $userLawyer->getDatatableAbogado();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
        $dni = $_POST['dni'];

        $deleteLawyer = $userLawyer->deleteAbogado($dni);
    
        if ($deleteLawyer) {
            echo json_encode(['status' => 'success', 'message' => 'Abogado eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar abogado']);
        }
    }
?>