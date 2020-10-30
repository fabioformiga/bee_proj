<?php

class Measure {    
    private $id_measure;
    private $sensor_type;
    private $date_measure;
    private $value_measure;
    private $id_hive;
                   
    public function __construct(){
        
    }
    
    function getIdMeasure() {
        return $this->id_measure;
    }

    function getSensorType() {
        return $this->sensor_type;
    }

    function getDateMeasure() {
        return $this->date_measure;
    }

    function getValueMeasure() {
        return $this->value_measure;
    }

    function getIdHive() {
        return $this->id_hive;
    }

    function setIdMeasure($id_measure) {
        $this->id_measure = $id_measure;
    }

    function setSensorType($sensor_type) {
        $this->sensor_type = $sensor_type;
    }

    function setDateMeasure($date_measure) {
        $this->date_measure = $date_measure;
    }

    function setValueMeasure($value_measure) {
        $this->value_measure = $value_measure;
    }

    function setIdHive($id_hive) {
        $this->id_hive = $id_hive;
    }
}
