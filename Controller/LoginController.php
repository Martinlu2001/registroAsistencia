<?php
    session_start();
    require_once "../Model/LoginModel.php";
    require_once "../config/conexion.php";

    if ($_POST) {
        $user = $_POST['usuario'];
        $password = $_POST['password'];
        
        $userModel = new LoginModel($mysqli);
        $userData = $userModel->getUsuario($user);

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
                echo json_encode(['status' => 'success', 'redirect' => '../dashboard.php']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos.']);
        }
    }
?>
