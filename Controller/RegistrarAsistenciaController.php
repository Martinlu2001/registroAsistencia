<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Model/RegistrarAsistenciaModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    $userAttendance = new RegistrarAsistenciaModel($mysqli);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "create") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $dateBirth = $_POST['dateBirth'];
        $age = $_POST['age'];
        $rol = $_POST['rol'];
        $gender = $_POST['gender'];
        $date_attendance = $_POST['dateAttendance'];
        $hour_attendance =$_POST['hourAttendance'] ;
        $lawyer = $_POST['lawyer'];
        $current_user = $_POST['current_user'];

        $createUser = $userAttendance->createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender, $date_attendance, $hour_attendance, $lawyer, $current_user);

        if ($createUser) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
        }
    }

    function readDatatable(){
        global $userAttendance;
        return $userAttendance->getDatatableUser();
    }

    function readLawyerData(){
        global $userAttendance;
        return $userAttendance->getLawyerData();
    }

    /*if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
        $dni = $_POST['dni'];

        $deleteSecurity = $userSecurity->deleteVigilante($dni);
    
        if ($deleteSecurity) {
            echo json_encode(['status' => 'success', 'message' => 'Vigilante eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar vigilante']);
        }
    }*/
?>