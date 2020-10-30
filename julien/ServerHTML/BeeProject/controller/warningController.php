<?php
    require('../model/warningModel.php');

    class WarningController {
        private $warning;

        public function __construct() {
            $this->warning = new WarningModel();
        }

        /*************************************************************

            WARNING MANAGEMENT

        *************************************************************/        
        function loadWarning() {
            $Dashboard_view = "warning_system";
            require_once('../views/warning_system/warningView.php');
        }
    }
?>