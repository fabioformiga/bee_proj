<?php

require_once '../config/DBConnection.php';
require_once 'user.php';

class UserModel extends User {
    private $table;
    
    public function __construct() {
        $this->table = "users";
        parent::__construct($this->table);
    }
        
    /*************************************************************

        AUTH QUERIES

    *************************************************************/

    public function login(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT id_user, username, password FROM users WHERE username = ? LIMIT 1";
            $record = $db->prepare($sql);
            $record->execute(array($this->getUsername()));
            $valueExist = $record->rowCount();
            if ($valueExist) {
                $dataList = $record->fetch();
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

    public function getUserHives() {
        $id_user = $this->getIdUser();
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = "SELECT id_hive FROM hive_location WHERE id_user = ?";
            $record = $db->prepare($sql);
            $record->execute(array($this->getIdUser()));
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
