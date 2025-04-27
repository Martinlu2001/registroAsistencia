<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Model/PerfilModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";
    
    class PerfilController {
        private $perfilModel;
    
        public function __construct($mysqli) {
            $this->perfilModel = new PerfilModel($mysqli);
        }
    
        public function actualizarPerfil() {
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "actualizar") {
                $dni = $_POST['dni'];
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
    
                if (empty($password)) {
                    $actualizado = $this->perfilModel->updatePerfilSinPassword($dni, $name, $lastname, $phone, $gender);
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $actualizado = $this->perfilModel->updatePerfilConPassword($dni, $name, $lastname, $hashedPassword, $phone, $gender);
                }
    
                if ($actualizado) {
                    echo json_encode(['status' => 'success', 'message' => 'Perfil actualizado correctamente', 'nombre' => $name. ' '. $lastname]);
                    
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar perfil']);
                }
            }
        }
    
        public function getPerfil($id) {
            return $this->perfilModel->getUser($id);
        }
    }
    
    $perfilController = new PerfilController($mysqli);
    $perfilController->actualizarPerfil();
?>
