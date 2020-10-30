<?php

require_once '../config/DBConnection.php';

class DropdownLocalModel {
    
    private $table;
    
    public function __construct() {
        $this->table = "location";
    }

    public function loadLocalDropdown(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try{
            $db->beginTransaction();
            $sql = "SELECT Id_location, name_location FROM  " . $this->table;
            $record = $db->prepare($sql);
            $record->execute();
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
