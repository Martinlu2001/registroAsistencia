<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class RegistrarAsistenciaModel{
        private $conexion;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }
        //crea usuario, inserta en cliente, asistencia y historial
        public function createUser($dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender, $date_attendance, $time_attendance, $lawyer, $current_user){
            $dateBirth = date('Y-m-d', strtotime($dateBirth));
            //Insertar cliente
            $sqlCliente = "
                INSERT INTO cliente (dniCliente, nameCliente, apelliCliente, celCliente, datebirthCliente, ageCliente, rolCliente, sexCliente) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtCliente = $this->conexion->prepare($sqlCliente);
            $stmtCliente->bind_param("ssssssss", $dni, $name, $lastname, $phone, $dateBirth, $age, $rol, $gender);
            $stmtCliente->execute();

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
            $time_attendance = date('H:i:s', strtotime($time_attendance));
            $sqlAsistencia = "
                INSERT INTO asistencia (Vigilante_dniVigilante, Cliente_dniCliente, Abogado_dniAbogado, nameAbogado, apelliAbogado, horaAsistencia, fechaAsistencia) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtAsistencia = $this->conexion->prepare($sqlAsistencia);
            $stmtAsistencia->bind_param("sssssss", $current_user, $dni, $lawyer, $nameAbogado, $apelliAbogado, $time_attendance, $date_attendance);
            $stmtAsistencia->execute();

            //Insertar en historial
            $sqlHistorial = "
                INSERT INTO historial (Historial_Vigilante_dniVigilante, Historial_Cliente_dniCliente, nameCliente, apelliCliente, nameAbogado, apelliAbogado, fechaAsistencia, horaAsistencia) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtHistorial = $this->conexion->prepare($sqlHistorial);  
            $stmtHistorial->bind_param("ssssssss", $current_user, $dni, $name, $lastname, $nameAbogado, $apelliAbogado, $date_attendance, $time_attendance);

            if ($stmtHistorial->execute()) {
                return true;
            } else {
                return null;
            }
        }
        //actualiza cliente
        public function updateUser($dni, $name, $lastname, $phone, $dateBirth, $age, $gender){
            $dateBirth = date('Y-m-d', strtotime($dateBirth));
            //Actualizar cliente en cliente
            $sqlCliente = "
                UPDATE cliente 
                SET nameCliente = ?, apelliCliente = ?, celCliente = ?, datebirthCliente = ?, ageCliente = ?, sexCliente = ? 
                WHERE dniCliente = ?";

            $stmtCliente = $this->conexion->prepare($sqlCliente);
            $stmtCliente->bind_param("sssssss", $name, $lastname, $phone, $dateBirth, $age, $gender, $dni);
            $stmtCliente->execute();

            //actualizar cliente en historial
            $sqlHistorial = "
                UPDATE historial
                SET nameCliente = ?, apelliCliente = ? 
                WHERE Historial_Cliente_dniCliente = ?";

            $stmtHistorial = $this->conexion->prepare($sqlHistorial);
            $stmtHistorial->bind_param("sss", $name, $lastname, $dni);

            if ($stmtHistorial->execute()) {
                return true;
            } else {
                return null;
            }
        }
        //actualiza asistencia en asistencia y historial
        public function updateDataAttendance( $current_user, $dni, $name, $lastname, $date_attendance, $time_attendance, $dniLawyer){
           // Obtener nombre de abogado por su DNI
            $sqlAbogado = "
                SELECT nameAbogado, apelliAbogado 
                FROM abogado 
                WHERE dniAbogado = ?";
            $stmtAbogado = $this->conexion->prepare($sqlAbogado);
            $stmtAbogado->bind_param("s", $dniLawyer);
            $stmtAbogado->execute();
            $resultAbogado = $stmtAbogado->get_result();

            if ($resultAbogado->num_rows === 0) {
                return ["error" => "Abogado no encontrado"];
            }

            $rowAbogado = $resultAbogado->fetch_assoc();
            $nameAbogado = $rowAbogado['nameAbogado'];
            $apelliAbogado = $rowAbogado['apelliAbogado'];
           
            $date_attendance = date('Y-m-d', strtotime($date_attendance));
            $time_attendance = date('H:i:s', strtotime($time_attendance));

            // Insertar en historial la nueva asistencia
            $sqlHistorial = "
            INSERT INTO historial (Historial_Vigilante_dniVigilante, Historial_Cliente_dniCliente, nameCliente, apelliCliente, nameAbogado, apelliAbogado, fechaAsistencia, horaAsistencia) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtHistorial = $this->conexion->prepare($sqlHistorial);
            $stmtHistorial->bind_param("ssssssss", $current_user, $dni, $name, $lastname, $nameAbogado, $apelliAbogado, $date_attendance, $time_attendance);
            $stmtHistorial->execute();

            //actualizar asistencia en la tabla asistencia
            $sqlAsistencia = "
                UPDATE asistencia 
                SET Vigilante_dniVigilante = ?, Abogado_dniAbogado = ?, nameAbogado = ?, apelliAbogado = ?, horaAsistencia = ?, fechaAsistencia = ? 
                WHERE Cliente_dniCliente = ?";
            $stmtAsistencia = $this->conexion->prepare($sqlAsistencia);
            $stmtAsistencia->bind_param("sssssss", $current_user, $dniLawyer, $nameAbogado, $apelliAbogado, $time_attendance, $date_attendance, $dni);

            if ($stmtAsistencia->execute()) {
                return true;
            } else {
                return null;
            }
        }
        //obtiene los datos para la ventana modal del cliente y la tabla principal y loa datos de asistencia
        public function getDatatableUser(){
            $sql = "
                SELECT cliente.dniCliente, cliente.nameCliente, cliente.apelliCliente, cliente.celCliente, cliente.datebirthCliente, cliente.ageCliente, cliente.rolCliente, cliente.sexCliente,
                asistencia.Cliente_dniCliente, asistencia.Abogado_dniAbogado,asistencia.fechaAsistencia, asistencia.horaAsistencia, asistencia.nameAbogado, asistencia.apelliAbogado
                FROM cliente
                CROSS JOIN asistencia
                WHERE cliente.dniCliente = asistencia.Cliente_dniCliente";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->get_result();
        }
        //obtene la tabla de historial de asistencia de un cliente
        public function getUserAttendanceData($dni){
            $sql = "
                SELECT fechaAsistencia, horaAsistencia, nameAbogado, apelliAbogado
                FROM historial
                WHERE Historial_Cliente_dniCliente = ?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            return $stmt->get_result();
        }
        //obtiene los datos de los abogados
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