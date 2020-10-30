<?php
require_once '../config/properties.php';
require_once '../model/CheckboxHiveModel.php';

class CheckboxHiveController{

    public function __construct() {          
    }
    
    public function loadCheckboxHive($local){
        try {
            $checkboxHive = new CheckboxHiveModel;
            $response = $checkboxHive->loadCheckboxHive($local);
            return json_encode($response);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
            
    }
    
}