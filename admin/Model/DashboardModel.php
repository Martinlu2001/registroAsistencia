<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class DashboardModel{
        private $conexion;
        private $count;

        public function __construct($mysqli){
            $this->conexion = $mysqli;
        }

        public function getLawyer(){
            global $count;
            $sql = "
                SELECT 
                COUNT(*) FROM abogado";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return (int) $count;
        } 

        public function getSecurity(){
            global $count;
            $sql = "
                SELECT COUNT(*) FROM vigilante";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return (int) $count;
        }

        public function getClient(){
            global $count;
            $sql = "
                SELECT COUNT(*) FROM cliente";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return (int) $count;
        }
    }
?>