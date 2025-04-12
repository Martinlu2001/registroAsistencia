<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/admin/Model/PerfilAdminModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";
    
    $perfilAdminModel = new PerfilAdminModel($mysqli);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "actualizar") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        // Si el usuario dejó la contraseña en blanco, no se actualiza.
        if (empty($password)) {
            $actualizado = $perfilAdminModel->updatePerfilSinPassword($dni, $name, $lastname, $phone, $gender);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $actualizado = $perfilAdminModel->updatePerfilConPassword($dni, $name, $lastname, $hashedPassword, $phone, $gender);
        }

        if ($actualizado) {
            echo json_encode(['status' => 'success', 'message' => 'Perfil actualizado correctamente', 'nombre' => $name. ' '. $lastname]);
            //echo 'Perfil actualizado correctamente';
            //$_SESSION["mensaje"] = "Perfil actualizado correctamente.";
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar perfil']);
            //echo 'Error al actualizar perfil';
            //$_SESSION["mensaje"] = "Error al actualizar perfil.";
        }
        //header("Location: ../perfil.php");
        //exit();
    }

    // Función para obtener los datos del usuario
    function getPerfil($id) {
        global $perfilAdminModel;
        return $perfilAdminModel->getUser($id);
    }
?>
