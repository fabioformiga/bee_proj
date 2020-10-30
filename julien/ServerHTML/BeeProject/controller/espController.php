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
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('Europe/Lisbon');
            $date = date("Y-m-d H:i:s");
            $this->espModel->insertTemperatureValue($hive_id, $temp_value, $date);
            $this->espModel->insertHumidityValue($hive_id, $humi_value, $date);
            $this->espModel->insertWeightValue($hive_id, $weight_value, $date);
            echo json_encode($date);
        }

        function getESPData() {
            echo '<script type="text/javascript">',
                'getEspData();',
                '</script>'
            ;
        }
    }
?>