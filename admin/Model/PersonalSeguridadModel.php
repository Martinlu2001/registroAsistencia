<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class PersonalSeguridadModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function createVigilante($dni, $name, $lastname, $password, $phone, $rol, $gender){
            $sql = "
                INSERT INTO vigilante (dniVigilante, nameVigilante, apelliVigilante, passwordVigilante, rolVigilante, celVigilante, sexVigilante) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("sssssss", $dni, $name, $lastname, $password, $rol, $phone, $gender);
           
            if ($stmt->execute()) {
                return true;
            } else {
                return null;
            }
        }

        public function deleteVigilante($dni){
            $sql = "
                DELETE FROM vigilante WHERE dniVigilante = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $dni);
            return $stmt->execute();
        }

        public function getDatatableVigilante(){
            $sql = "
                SELECT * 
                FROM vigilante";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>