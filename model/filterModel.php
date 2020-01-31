<?php

require_once '../config/DBConnection.php';

class FilterModel {
    private $tableHive;
    private $tableUser;
    
    public function __construct() {
        $this->tableHive = "hive";
        $this->tableUser = "users";
    }
        
    /*************************************************************

        FILTER QUERIES

    *************************************************************/

    public function getHiveNames(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT name_hive from " . $this->tableHive;
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

    public function getHiveUsers() {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT username from " . $this->tableUser;
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

    public function setFilterPeriod($period) {
        $_SESSION["minDate"] = "NULL";
        $_SESSION["maxDate"] = "NULL";
        $_SESSION["filterPeriod"] = $period;
    }

    public function setFilterLocation($name_hive) {
        $_SESSION["filterLocation"] = $name_hive;
    }

    public function setFilterDate($min_date, $max_date, $filter_date_mode) {
        switch($filter_date_mode) {
            case 1:
                // If the datetimepicker are unfill
                $_SESSION["minDate"] = "NULL";
                $_SESSION["maxDate"] = "NULL";
            break;
            case 2:
                // If the min date is empty
                $_SESSION["minDate"] = "NULL";
                $_SESSION["maxDate"] = $max_date;
            break;
            case 3:
                // If the max date is empty
                $_SESSION["minDate"] = $min_date;
                $_SESSION["maxDate"] = "NULL";
            break;
            case 0:
                $_SESSION["minDate"] = $min_date;
                $_SESSION["maxDate"] = $max_date;
            break;
        }
    }

    public function setFilterUser($username) {
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        $user_id;
        try {
            $db->beginTransaction();
            $sql = "SELECT id_user FROM " . $this->tableUser . " WHERE username=\"" . $username . "\" LIMIT 1";
            $record = $db->prepare($sql);
            $record->execute();
            $valueExist = $record->rowCount();
            if ($valueExist) {
                $user_id = $record->fetch();
                $db->commit();
                $db = null;
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
        $_SESSION["filterUser"] = $user_id;
    }

    public function setFilterHour($hour) {
        $_SESSION["HourPeriod"] = $hour;
    }
}
