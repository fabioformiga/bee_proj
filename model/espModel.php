<?php
require_once '../config/DBConnection.php';

class EspModel {
    private $table;
    
    public function __construct() {
        $this->table = "esp_measure";
    }

    /*************************************************************

        SENSORS MANAGEMENT

    *************************************************************/
    public function insertTemperatureValue($hive_id, $temp_value, $date) {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $type_measure = "temperature";
            $sql = "INSERT INTO " . $this->table . " (type_measure, measure_value, date_measure, id_hive) VALUES (?,?,?,?)";
            $record = $db->prepare($sql);
            $record->execute([$type_measure, $temp_value, $date, $hive_id]);
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        } 
    }

    public function insertHumidityValue($hive_id, $humi_value, $date) {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $type_measure = "humidity";
            $sql = "INSERT INTO " . $this->table . " (type_measure, measure_value, date_measure, id_hive) VALUES (?,?,?,?)";
            $record = $db->prepare($sql);
            $record->execute([$type_measure, $humi_value, $date, $hive_id]);
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        } 
    }

    public function insertWeightValue($hive_id, $weight_value, $date) {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $type_measure = "weight";
            $sql = "INSERT INTO " . $this->table . " (type_measure, measure_value, date_measure, id_hive) VALUES (?,?,?,?)";
            $record = $db->prepare($sql);
            $record->execute([$type_measure, $weight_value, $date, $hive_id]);
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        } 
    }

}
?>