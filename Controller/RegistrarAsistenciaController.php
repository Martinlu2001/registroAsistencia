<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Model/RegistrarAsistenciaModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class RegistrarAsistenciaController{
        private $userAttendance;

        public function __construct($mysqli) {
            $this->userAttendance = new RegistrarAsistenciaModel($mysqli);
        }

        public function handleRequest() {
            $action = $_POST['action'] ?? '';
    
            switch ($action) {
                case "create":
                    $this->createUser();
                    break;
                case "updateDataUser":
                    $this->updateUser();
                    break;
                case "updateAttendance":
                    $this->updateAttendance();
                    break;
            }
        }

        private function createUser(){
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
    
            $createUser = $this->userAttendance->createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender, $date_attendance, $time_attendance, $lawyer, $current_user);
    
            if ($createUser) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente']);
                
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
            }
        }

        private function updateUser(){
            $dni = $_POST['dni'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $dateBirth = $_POST['dateBirth'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
    
            $updateUser = $this->userAttendance->updateUser($dni, $name, $lastname, $phone, $dateBirth, $age, $gender);
    
            if ($updateUser) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado correctamente']);
                
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar usuario']);
            }
        }

        private function updateAttendance(){
            $current_user = $_POST['current_user'];
            $dni = $_POST['dni'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $date_attendance = $_POST['dateUpdateAttendance'];
            $time_attendance =$_POST['timeUpdateAttendance'] ;
            $lawyer = $_POST['lawyerUpdateAttendance'];
    
            $updateAttendance = $this->userAttendance->updateDataAttendance($current_user, $dni, $name, $lastname, $date_attendance, $time_attendance, $lawyer);
    
            if ($updateAttendance) {
                echo json_encode(['status' => 'success', 'message' => 'Asistencia actualizada correctamente']);
                
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar asistencia']);
            }
        }

        //muestra la tabla de usuarios y su ultima asistencia
        public function readDatatable(){
            return $this->userAttendance->getDatatableUser();
        }
        //muestra la lista de abogados
        public function readLawyerData(){
            return $this->userAttendance->getLawyerData();
        }
        //muestra la tabla de asistencia
        public function readUserAttendanceData($dni){
            return $this->userAttendance->getUserAttendanceData($dni);
        }
    }
    
    $controller = new RegistrarAsistenciaController($mysqli);
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
        $controller->handleRequest();
    }
?>