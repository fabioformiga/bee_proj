<?php
    require('../model/dashboardModel.php');

    class DashboardController {
        
        private $dashboardModel;

        public function __construct() {
            $this->dashboardModel = new DashboardModel();
        }

        /*************************************************************

            CHART MANAGEMENT

        *************************************************************/
        function loadDashboard() {
            $hive_list = $this->dashboardModel->getHiveNames();
            require_once('../views/mainpage.php');
        }
    }
?>