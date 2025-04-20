<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Model/PerfilModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";
    
    $perfilModel = new PerfilModel($mysqli);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "actualizar") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        if (empty($password)) {
            $actualizado = $perfilModel->updatePerfilSinPassword($dni, $name, $lastname, $phone, $gender);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $actualizado = $perfilModel->updatePerfilConPassword($dni, $name, $lastname, $hashedPassword, $phone, $gender);
        }

        if ($actualizado) {
            echo json_encode(['status' => 'success', 'message' => 'Perfil actualizado correctamente', 'nombre' => $name. ' '. $lastname]);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar perfil']);
        }
    }

    function getPerfil($id) {
        global $perfilModel;
        return $perfilModel->getUser($id);
    }
?>
