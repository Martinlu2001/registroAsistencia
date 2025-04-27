<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Model/RegistrarAsistenciaModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    $userAttendance = new RegistrarAsistenciaModel($mysqli);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //crear cliente
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
        $time_attendance =$_POST['timeAttendance'] ;
        $lawyer = $_POST['lawyer'];
        $current_user = $_POST['current_user'];

        $createUser = $userAttendance->createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender, $date_attendance, $time_attendance, $lawyer, $current_user);

        if ($createUser) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
        }
    }
    //muestra la tabla de usuarios y su ultima asistencia
    function readDatatable(){
        global $userAttendance;
        return $userAttendance->getDatatableUser();
    }
    //muestra la lista de abogados
    function readLawyerData(){
        global $userAttendance;
        return $userAttendance->getLawyerData();
    }
    //muestra la tabla de asistencia
    function readUserAttendanceData($dni){
        global $userAttendance;
        return $userAttendance->getUserAttendanceData($dni);
    }

    //modificar  cliente
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "updateDataUser") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $dateBirth = $_POST['dateBirth'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $updateUser = $userAttendance->updateUser($dni, $name, $lastname, $phone, $dateBirth, $age, $gender);

        if ($updateUser) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar usuario']);
        }
    }


    //modificar asistencia
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "updateAttendance") {
        $current_user = $_POST['current_user'];
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $date_attendance = $_POST['dateUpdateAttendance'];
        $time_attendance =$_POST['timeUpdateAttendance'] ;
        $lawyer = $_POST['lawyerUpdateAttendance'];

        $updateAttendance = $userAttendance->updateDataAttendance($current_user, $dni, $name, $lastname, $date_attendance, $time_attendance, $lawyer);

        if ($updateAttendance) {
            echo json_encode(['status' => 'success', 'message' => 'Asistencia actualizada correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar asistencia']);
        }
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