<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/admin/Model/PersonalSeguridadModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    $userSecurity = new PersonalSeguridadModel($mysqli);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "create") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['dni'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $gender = $_POST['gender'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createSecurity = $userSecurity->createVigilante($dni, $name, $lastname, $hashedPassword, $phone, $rol, $gender);

        if ($createSecurity) {
            echo json_encode(['status' => 'success', 'message' => 'Vigilante registrado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar vigilante']);
        }
    }

    function readDatatableVigilante(){
        global $userSecurity;
        return $userSecurity->getDatatableVigilante();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
        $dni = $_POST['dni'];

        $deleteSecurity = $userSecurity->deleteVigilante($dni);
    
        if ($deleteSecurity) {
            echo json_encode(['status' => 'success', 'message' => 'Vigilante eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar vigilante']);
        }
    }
?>