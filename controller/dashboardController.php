<?php
    require('../model/hiveModel.php');

    class DashboardController {
        
        private $hive;

        public function __construct() {
            $this->hive = new HiveModel();
        }

        /*************************************************************

            CHART MANAGEMENT

        *************************************************************/
        function loadDashboard() {
            $hive_list = $this->hive->getHivesWithRights();
            require_once('../views/mainpage.php');
        }
    }
?>