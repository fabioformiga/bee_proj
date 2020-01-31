<?php

require_once '../config/DBConnection.php';
//require_once 'weight.php';

class WarningModel /*extends Weight*/ {
    private $table;
    
    public function __construct() {
        $this->table = "type_measure";
        //parent::__construct($this->table);
    }
        
    /*************************************************************

        WARNING QUERIES

    *************************************************************/

    public function getThreshold(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = $this->checkFilter();

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
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        } 
    }

}
