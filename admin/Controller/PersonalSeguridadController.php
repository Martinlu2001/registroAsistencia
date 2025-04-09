<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/admin/Model/PersonalSeguridadModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    $userSecurity = new PersonalSeguridadModel($mysqli);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //crear vigilante
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "create") {
        $dni = $_POST['dni'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['dni'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $gender = $_POST['gender'];

        //se ha cargado una imagen
        if($_FILES["image"]["error"] === UPLOAD_ERR_OK){
            $src = $_FILES["image"]["tmp_name"];
            $imageName = uniqid().$_FILES["image"]["name"];
            $target = "../assets/images/".$imageName;
            move_uploaded_file($src, $target);
        } else {
            $imageName = "User_icon.png";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createSecurity = $userSecurity->createVigilante($dni, $name, $lastname, $hashedPassword, $phone, $rol, $gender, $imageName);

        if ($createSecurity) {
            echo json_encode(['status' => 'success', 'message' => 'Vigilante registrado correctamente']);
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar vigilante']);
        }
    }

    //mostrar datatable Vigilante
    function readDatatableVigilante(){
        global $userSecurity;
        return $userSecurity->getDatatableVigilante();
    }


    //leer datos de vigilante
    /*function readVigilante(){
        global $userSecurity;
        return $userSecurity->getVigilante();
    }*/

    //modificar datos de vigilante

    //eliminar datos de vigilante


?>