<?php
require_once '../config/DBConnection.php';

class DashboardModel {
    private $table;
    
    public function __construct() {
        $this->table = "hive";
    }
        
    /*************************************************************

        HIVE QUERIES

    *************************************************************/

    public function getHiveNames(){
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

}
?>