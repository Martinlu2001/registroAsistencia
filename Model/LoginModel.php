<?php
    require_once "../config/conexion.php";

    class LoginModel {
        private $conexion;

        public function __construct($mysqli) {
            $this->conexion = $mysqli;
        }

        public function getUsuario($user) {
            #$sql = "SELECT dniVigilante, passwordVigilante, nameVigilante, apelliVigilante, celVigilante, sexVigilante FROM Vigilante WHERE dniVigilante=?";
            $sql = "
                SELECT 'admin' AS rol, dniAdmin AS dniUser, passwordAdmin AS passwordUser, nameAdmin AS nameUser, apelliAdmin AS apelliUser , celAdmin AS celUser, sexAdmin AS sexUser 
                FROM admin WHERE dniAdmin = ?
                UNION
                SELECT 'vigilante' AS rol, dniVigilante AS dniUser, passwordVigilante AS passwordUser, nameVigilante AS nameUser, apelliVigilante AS apelliUser, celVigilante AS celUser, sexVigilante AS sexUser 
                FROM vigilante WHERE dniVigilante = ?
                ";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ss", $user, $user);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        }
    }
?>
