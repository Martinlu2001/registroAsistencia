<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/admin/Model/DashboardModel.php";
    require_once  $_SERVER['DOCUMENT_ROOT'] . "/config/conexion.php";

    class DashboardController{
        private $dashboardModel;

        public function __construct($mysqli) {
            $this->dashboardModel = new DashboardModel($mysqli);
        }

        public function getDataLawyer() {
            return $this->dashboardModel->getLawyer();
        }

        public function getDataSecurity() {
            return $this->dashboardModel->getSecurity();
        }

        public function getDataClient() {
            return $this->dashboardModel->getClient();
        }
    }
?>