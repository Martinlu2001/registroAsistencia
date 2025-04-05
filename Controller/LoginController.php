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

            // Ajax según rol
            if ($userData['rol'] === "admin") {
                //header("Location: ../admin/dashboard.php");
                echo json_encode(['status' => 'success', 'redirect' => '../admin/dashboard.php']);
                //echo 'admin';
            } else {
                //header("Location: ../dashboard.php");
                //echo 'user';
                echo json_encode(['status' => 'success', 'redirect' => '../dashboard.php']);
            }
            //exit();
        } else {
            /*$_SESSION["error"] = "Usuario o contraseña incorrectos.";
            header("Location: ../login.php");
            exit();*/
            //echo 'Usuario o contraseña incorrectos';
            echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos.']);
        }
    }
?>
