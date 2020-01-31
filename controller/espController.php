<?php
    require('../model/espModel.php');

    class ESPController {
        
        private $espModel;

        public function __construct() {
            $this->espModel = new EspModel();
        }

        /*************************************************************

            ESP MANAGEMENT

        *************************************************************/
        function storeESPData($hive_id, $temp_value, $humi_value, $weight_value) {
            $date = date("Y-m-d H:i:s");
            $this->espModel->insertTemperatureValue($hive_id, $temp_value, $date);
            $this->espModel->insertHumidityValue($hive_id, $humi_value, $date);
            $this->espModel->insertWeightValue($hive_id, $weight_value, $date);
        }

        function getESPData() {
            echo '<script type="text/javascript">',
                'getEspData();',
                '</script>'
            ;
        }
    }
?>