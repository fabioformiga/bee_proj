<?php

require_once '../config/DBConnection.php';
require_once 'Filter.php';

class FilterModel extends Filter {
    
    private $table;
    
    public function __construct() {
        $this->table = "measure";
        parent::__construct($this->table);
    }
        
    public function filter(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try{
            switch ($this->getFilterDate()) {
                case "Week":
                    $date_request = date('Y-m-d', strtotime('-7 day'));
                    break;
                case "Month":
                    $date_request = date('Y-m-d', strtotime('-31 day'));
                    break;
                case "Year":
                    $date_request = date('Y-m-d', strtotime('-365 day'));
                    break;
            }

            $hive_selected = explode(",",$this->getFilterHive());

            $dateNow = date('Y-m-d', time());
            $db->beginTransaction();
            if($this->getFilterType() == "local" ) {
                //$sql = "SELECT date_measure, AVG(value_measure), hive.id_location, location.name_location FROM  " . $this->table . ", hive INNER JOIN location ON hive.id_location = location.Id_location WHERE hive.id_location = " . $this->getFilterLocal() . " AND sensor_type =  'T' AND DATE(date_measure) between ? and ? GROUP BY id_location, date_measure ORDER BY date_measure";
                $sql = "SELECT date_measure, AVG(value_measure), hive.id_location, location.name_location FROM  " . $this->table . " INNER JOIN hive ON measure.id_hive = hive.id_hive INNER JOIN location ON hive.id_location = location.Id_location WHERE hive.id_location = " . $this->getFilterLocal() . " AND sensor_type =  'T' AND DATE(date_measure) between ? and ? GROUP BY id_location, date_measure ORDER BY date_measure";
            } elseif($this->getFilterType() == "hive") {
                if(count($hive_selected) == 1) {
                    $sql = "SELECT date_measure, value_measure, hive.id_location, location.name_location FROM " . $this->table . " INNER JOIN hive ON measure.id_hive = hive.id_hive INNER JOIN location ON hive.id_location = location.Id_location WHERE hive.id_location= " . $this->getFilterLocal() . " AND hive.reference_hive IN (" . $this->getFilterHive() . ") AND DATE(date_measure) between ? and ? ORDER BY date_measure;";   
                } else {
                    $sql = "SELECT date_measure, AVG(value_measure), hive.id_location, location.name_location FROM " . $this->table . " INNER JOIN hive ON measure.id_hive = hive.id_hive INNER JOIN location ON hive.id_location = location.Id_location WHERE hive.id_location= " . $this->getFilterLocal() . " AND hive.reference_hive IN (" . $this->getFilterHive() . ") AND DATE(date_measure) between ? and ? GROUP BY id_location, date_measure ORDER BY date_measure;";   
                }
            } else {
                $sql = "SELECT date_measure, value_measure, hive.id_location, location.name_location FROM  " . $this->table . ", hive INNER JOIN location ON hive.id_location = location.Id_location WHERE sensor_type = 'T' AND DATE(date_measure) between ? and ? ORDER BY date_measure";
            } 
            
            $record = $db->prepare($sql);
            $record->execute( array( $date_request , $dateNow ) );
            $valueExist = $record->rowCount();
            if ($valueExist) {
                $dataList = $record->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                $db = null;
                return $dataList;
            } else {
                $db->commit();
                $db = null;
                return $valueExist;
            }            
        }catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }   
    }
}
