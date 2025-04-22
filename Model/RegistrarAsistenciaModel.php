<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class RegistrarAsistenciaModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender, $date_attendance, $hour_attendance, $lawyer, $current_user){
            $dateBirth = date('Y-m-d', strtotime($dateBirth));
            //Insertar cliente
            $sqlCliente = "
                INSERT INTO cliente (dniCliente, nameCliente, apelliCliente, celCliente, datebirthCliente, ageCliente, rolCliente, sexCliente) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtCliente = $this->conexion->prepare($sqlCliente);
            $stmtCliente->bind_param("ssssssss", $dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender);
            
            if (!$stmtCliente->execute()) {
                return ["error" => "Error al insertar cliente"];
            }

            // Obtener nombre de abogado por su DNI
            $sqlAbogado = "
                SELECT nameAbogado, apelliAbogado 
                FROM abogado 
                WHERE dniAbogado = ?";
            $stmtAbogado = $this->conexion->prepare($sqlAbogado);
            $stmtAbogado->bind_param("s", $lawyer);
            $stmtAbogado->execute();
            $resultAbogado = $stmtAbogado->get_result();

            if ($resultAbogado->num_rows === 0) {
                return ["error" => "Abogado no encontrado"];
            }

            $rowAbogado = $resultAbogado->fetch_assoc();
            $nameAbogado = $rowAbogado['nameAbogado'];
            $apelliAbogado = $rowAbogado['apelliAbogado'];

            // Insertar en asistencia
            $date_attendance = date('Y-m-d', strtotime($date_attendance));
            $hour_attendance = date('H:i:s', strtotime($hour_attendance));
            $sqlAsistencia = "
                INSERT INTO asistencia (Vigilante_dniVigilante, Cliente_dniCliente, Abogado_dniAbogado, nameAbogado, apelliAbogado, horaAsistencia, fechaAsistencia) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtAsistencia = $this->conexion->prepare($sqlAsistencia);
            $stmtAsistencia->bind_param("sssssss", $current_user, $dni, $lawyer, $nameAbogado, $apelliAbogado, $hour_attendance, $date_attendance);

            if (!$stmtAsistencia->execute()) {
                return ["error" => "Error al registrar asistencia"];
            }

            return ["success" => true];
        }

        public function getDatatableUser(){
            $sql = "
                SELECT * 
                FROM cliente";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }

        public function getLawyerData(){
            $sql = "
                SELECT * 
                FROM abogado";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>