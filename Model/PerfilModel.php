<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class PerfilModel {
        private $conexion;

        public function __construct($mysqli) {
            $this->conexion = $mysqli;
        }

        public function getUser($id) {
            $sql = "
                SELECT dniVigilante, nameVigilante, apelliVigilante, rolVigilante, passwordVigilante, celVigilante, sexVigilante 
                FROM vigilante WHERE dniVigilante = ?";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
    
        public function updatePerfilSinPassword($dni, $name, $lastname, $phone, $gender) {
            $sql = "
                UPDATE vigilante SET nameVigilante=?, apelliVigilante=?, celVigilante=?, sexVigilante=? 
                WHERE dniVigilante=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("sssss", $name, $lastname, $phone, $gender, $dni);
            return $stmt->execute();
        }
    
        public function updatePerfilConPassword($dni, $name, $lastname, $hashedPassword, $phone, $gender) {
            $sql = "
                UPDATE vigilante SET nameVigilante=?, apelliVigilante=?, passwordVigilante=?, celVigilante=?, sexVigilante=? 
                WHERE dniVigilante=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssssss", $name, $lastname, $hashedPassword, $phone, $gender, $dni);
            return $stmt->execute();
        }
    }
?>