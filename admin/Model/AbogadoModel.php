<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class AbogadoModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function createAbogado($dni, $name, $lastname, $phone, $rol, $gender){
            $sql = "
                INSERT INTO abogado (dniAbogado, nameAbogado, apelliAbogado, rolAbogado, celAbogado, sexAbogado) 
                VALUES (?, ?, ?, ?, ?, ?)";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssssss", $dni, $name, $lastname, $rol, $phone, $gender);
           
            if ($stmt->execute()) {
                return true;
            } else {
                return null;
            }
        }

        public function deleteAbogado($dni){
            $sql = "
                DELETE FROM abogado WHERE dniAbogado = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $dni);
            return $stmt->execute();
        }

        public function getDatatableAbogado(){
            $sql = "
                SELECT * 
                FROM abogado";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>