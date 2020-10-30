<?php
require_once '../config/properties.php';
require_once '../model/FilterModel.php';

class FilterController{
    
    private $filter;

    public function __construct() {
        $this->filter = new FilterModel;           
    }
    
    public function filter($type,$date,$local,$hive){
        try {
            $this->filter->setFilterType($type);
            $this->filter->setFilterDate($date);
            $this->filter->setFilterLocal($local);
            $this->filter->setFilterHive($hive);

            $response = $this->filter->filter();
            return json_encode($response);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
            
    }
}