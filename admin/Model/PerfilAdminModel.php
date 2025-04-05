<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class PerfilAdminModel {
        private $conexion;

        public function __construct($mysqli) {
            $this->conexion = $mysqli;
        }

        public function getUser($id) {
            $sql = "
                SELECT dniAdmin, nameAdmin, apelliAdmin, rolAdmin, passwordAdmin, celAdmin, sexAdmin 
                FROM admin WHERE dniAdmin = ?";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
    
        public function updatePerfilSinPassword($dni, $name, $lastname, $phone, $gender) {
            $sql = "
                UPDATE admin SET nameAdmin=?, apelliAdmin=?, celAdmin=?, sexAdmin=? 
                WHERE dniAdmin=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("sssss", $name, $lastname, $phone, $gender, $dni);
            return $stmt->execute();
        }
    
        public function updatePerfilConPassword($dni, $name, $lastname, $hashedPassword, $phone, $gender) {
            $sql = "
                UPDATE admin SET nameAdmin=?, apelliAdmin=?, passwordAdmin=?, celAdmin=?, sexAdmin=? 
                WHERE dniAdmin=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssssss", $name, $lastname, $hashedPassword, $phone, $gender, $dni);
            return $stmt->execute();
        }
    }
?>