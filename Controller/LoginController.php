<?php
    session_start();
    require_once "../Model/LoginModel.php";
    require_once "../config/conexion.php";
    
    class LoginController {
        private $userModel;
    
        public function __construct($mysqli) {
            $this->userModel = new LoginModel($mysqli);
        }
    
        public function login() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user = $_POST['usuario'] ?? '';
                $password = $_POST['password'] ?? '';
    
                $userData = $this->userModel->getUsuario($user);
    
                if ($userData && password_verify($password, $userData['passwordUser'])) {
                    $_SESSION["dniUser"] = $userData['dniUser'];
                    $_SESSION["rolUser"] = $userData['rol'];
                    $_SESSION["nameUser"] = $userData['nameUser'];
                    $_SESSION["apelliUser"] = $userData['apelliUser'];
                    $_SESSION["celUser"] = $userData['celUser'];
                    $_SESSION["sexUser"] = $userData['sexUser'];
    
                    if ($userData['rol'] === "admin") {
                        echo json_encode(['status' => 'success', 'redirect' => '../admin/dashboard.php']);
                    } else {
                        echo json_encode(['status' => 'success', 'redirect' => '../registro_asistencia.php']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos.']);
                }
            }
        }
    }
    
    $controller = new LoginController($mysqli);
    $controller->login();
?>
