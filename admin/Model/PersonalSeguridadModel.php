<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class PersonalSeguridadModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function createVigilante($dni, $name, $lastname, $password, $phone, $rol, $gender, $image){
            $sql = "
                INSERT INTO vigilante (dniVigilante, nameVigilante, apelliVigilante, passwordVigilante, rolVigilante, celVigilante, sexVigilante, imageVigilante) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssssssss", $dni, $name, $lastname, $password, $rol, $phone, $gender, $image);
            /*$stmt->execute();
            return $stmt->get_result()->fetch_assoc();*/
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si la inserción fue exitosa, puedes retornar el ID del nuevo vigilante
                //return $this->conexion->insert_id;  // Retorna el ID del nuevo vigilante insertado
                return true;
            } else {
                // Si hubo un error en la ejecución, devuelve un error o null
                return null;
            }
        }

        /*public function getVigilante(){
            $sql = "
                SELECT dniVigilante, nameVigilante, apelliVigilante, rolVigilante, celVigilante, sexVigilante, imageVigilante 
                FROM vigilante WHERE dniVigilante = ?";
                
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }*/

        public function updateVigilante(){

        }

        public function deleteVigilante(){

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