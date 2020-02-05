<?php
require_once '../config/DBConnection.php';

class HiveModel {
    private $table;
    private $location_table;
    
    public function __construct() {
        $this->table = "hive";
        $this->location_table = "hive_location";
    }
        
    /*************************************************************

        HIVE QUERIES

    *************************************************************/

    public function getHivesWithRights(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT * from " . $this->table . " WHERE id_hive IN (" . $_SESSION["hive_rights"] . ")";
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

    public function getHiveList(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT id_hive, name_hive from " . $this->table;
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

    /*************************************************************

        HIVE LOCATION QUERIES

    *************************************************************/
    public function registerHiveUser($id_hive, $id_user) {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $sql = "INSERT INTO  " . $this->location_table . " (id_hive, id_user) VALUES (?, ?)";
            $record = $db->prepare($sql);
            $affectedLines = $record->execute([$id_hive, $id_user]); 

            return $affectedLines;     
        }
        catch (PDOException $exc){
            echo $exc->getMessage();
            return null;
        } 
    }

}
?>