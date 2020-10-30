<?php
require_once '../config/properties.php';
require_once '../model/DropdownLocalModel.php';

class DropdownLocalController{

    public function __construct() {          
    }
    
    public function loadLocalDropdown(){
        try {
            $dropdownLocal = new DropdownLocalModel;
            $response = $dropdownLocal->loadLocalDropdown();
            return json_encode($response);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
            
    }
    
}