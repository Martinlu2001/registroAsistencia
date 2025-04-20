<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class RegistrarAsistenciaModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender){
            $sql = "
                INSERT INTO cliente (dniCliente, nameCliente, apelliCliente, celCliente, datebirthCliente, ageCliente, rolCliente,  sexCliente) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssssssss", $dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender);
           
            if ($stmt->execute()) {
                return true;
            } else {
                return null;
            }
        }

        /*public function deleteVigilante($dni){
            $sql = "
                DELETE FROM vigilante WHERE dniVigilante = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $dni);
            return $stmt->execute();
        }*/

        public function getDatatableUser(){
            $sql = "
                SELECT * 
                FROM cliente";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>