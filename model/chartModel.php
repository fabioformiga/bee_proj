<?php
require_once '../config/DBConnection.php';

class ChartModel {
    private $table;
    
    public function __construct() {
        $this->table = "tmp_measure";
    }
        
    /*************************************************************

        CHART QUERIES

    *************************************************************/

    public function getMeasure($type_of_chart){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $db->beginTransaction();
            $sql = $this->checkFilter($type_of_chart);

            $record = $db->prepare($sql);
            $record->execute();
            $valueExist = $record->rowCount();
            if ($valueExist) {
                $dataList = $record->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                $db = null;
                return $dataList;
            } else {
                echo json_encode($sql);
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

    public function checkFilter($type_of_chart) {
        $sql = "";
        $sql_period = "";
        $sql_hive_list = "";
        

        switch($_SESSION["filterPeriod"]) {
            case "Hour":
                if($_SESSION["HourPeriod"] == "NULL") {
                    $sql_period = "AND HOUR(date_measure) = HOUR(CURRENT_TIME()) GROUP BY HOUR(date_measure), MINUTE(date_measure)";
                }
                else {
                    $sql_period = "AND HOUR(date_measure) = HOUR(\"" . $_SESSION["HourPeriod"] . ":00:00\") GROUP BY HOUR(date_measure), MINUTE(date_measure)";
                }
            break;
            case "Day":
                $sql_period = "AND date_measure >= (DATE_SUB(CURDATE(), INTERVAL 1 DAY)) GROUP BY HOUR(date_measure)";
            break;
            case "Week":
                $sql_period = "AND date_measure >= (DATE_SUB(CURDATE(), INTERVAL 1 WEEK)) GROUP BY DAY(date_measure)";
            break;
            case "Month":
                $sql_period = "AND date_measure >= (DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) GROUP BY DAY(date_measure)";
            break;
            case "Year":
                //$sql_select = "SELECT id_measure, AVG(measure_value), date_measure FROM " . $this->table;
                $sql_period = "AND date_measure >= (DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) GROUP BY MONTH(date_measure)";
            break;
        }

        if(strpos($_SESSION["filterLocation"], ',') !== false) {
            // If you have multiple selected
            $sql_hive_list = ", " . $this->table .".id_hive ";
            $sql_select = "SELECT id_measure, AVG(measure_value), date_measure, hive.name_hive FROM " . $this->table;
        } else {
            $sql_select = "SELECT id_measure, AVG(measure_value), date_measure FROM " . $this->table;
        }

        $sql_order =  "ORDER BY date_measure";

        if($_SESSION["filterLocation"] != "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL") {
            // location without date and user filtering
            $sql = $sql_select . " INNER JOIN hive on " . $this->table . ".id_hive = hive.id_hive WHERE type_measure=\"" . $type_of_chart . "\" AND hive.name_hive IN (" . $_SESSION["filterLocation"] . ") " . $sql_period . $sql_hive_list . $sql_order;
        } 
        else if($_SESSION["filterLocation"] == "NULL" && $_SESSION["minDate"] != "NULL" && $_SESSION["maxDate"] != "NULL" && $_SESSION["filterUser"] == "NULL") {
            // date without location and user filtering
            $sql = $sql_select . " WHERE id_hive IN (" . $_SESSION["hive_rights"] . ") AND type_measure=\"" . $type_of_chart . "\" AND date_measure BETWEEN \"" . $_SESSION["minDate"] . "\" AND \"" . $_SESSION["maxDate"] . "\" " . $sql_period . $sql_order;
        }
        else if($_SESSION["filterLocation"] == "NULL" && $_SESSION["minDate"] != "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL") {
            // min date without location, max date and user filtering
            $sql = $sql_select . " WHERE id_hive IN (" . $_SESSION["hive_rights"] . ") AND type_measure=\"" . $type_of_chart . "\" AND date_measure > \"" . $_SESSION["minDate"] . "\" " . $sql_period . $sql_order;
        }
        else if($_SESSION["filterLocation"] == "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] != "NULL" && $_SESSION["filterUser"] == "NULL") {
            // max date without location, min date and user filtering
            $sql = $sql_select . " WHERE id_hive IN (" . $_SESSION["hive_rights"] . ") AND type_measure=\"" . $type_of_chart . "\" AND date_measure < \"" . $_SESSION["maxDate"] . "\" " . $sql_period . $sql_order;
        }
        else if($_SESSION["filterLocation"] != "NULL" && $_SESSION["minDate"] != "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL") {
            // min date and location without max date and user filtering
            $sql = $sql_select . " INNER JOIN hive on " . $this->table . ".id_hive = hive.id_hive WHERE type_measure=\"" . $type_of_chart . "\" AND hive.name_hive IN (" . $_SESSION["filterLocation"] . ") AND " . $this->table . ".date_measure > \"" . $_SESSION["minDate"] ."\" " . $sql_period . $sql_hive_list . $sql_order;
        }
        else if($_SESSION["filterLocation"] != "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] != "NULL" && $_SESSION["filterUser"] == "NULL") {
            // max date and location without min date and user filtering
            $sql = $sql_select . " INNER JOIN hive on " . $this->table . ".id_hive = hive.id_hive WHERE type_measure=\"" . $type_of_chart . "\" AND hive.name_hive IN (" . $_SESSION["filterLocation"] . ") AND " . $this->table . ".date_measure < \"" . $_SESSION["maxDate"] ."\" " . $sql_period . $sql_hive_list . $sql_order;
        }
        else if($_SESSION["filterLocation"] != "NULL" && $_SESSION["minDate"] != "NULL" && $_SESSION["maxDate"] != "NULL" && $_SESSION["filterUser"] == "NULL") {
            // date and location without user filtering
            $sql = $sql_select . " INNER JOIN hive on " . $this->table . ".id_hive = hive.id_hive WHERE type_measure=\"" . $type_of_chart . "\" AND hive.name_hive IN (" . $_SESSION["filterLocation"] . ") AND date_measure BETWEEN \"" . $_SESSION["minDate"] . "\" AND \"" . $_SESSION["maxDate"] . "\" " . $sql_period . $sql_hive_list . $sql_order;
        }
        else if ($_SESSION["filterLocation"] == "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL") {
            $sql = $sql_select . " WHERE id_hive IN (" . $_SESSION["hive_rights"] . ") AND type_measure=\"" . $type_of_chart . "\" " . $sql_period . $sql_order;
        }
        return $sql;
    }

}


/*         else if ($_SESSION["filterLocation"] != "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL" && $_SESSION["filterPeriod"] != "NULL") {
            // period and location without user filtering
            $sql = "SELECT id_measure, AVG(measure_value), date_measure, " . $this->table . ".id_hive from " . $this->table . " INNER JOIN hive on measure.id_hive = hive.id_hive WHERE type_measure=\"" . $type_of_chart . "\" AND hive.name_hive=\"" . $_SESSION["filterLocation"] . "\" AND date_measure >= DATE(NOW()) - INTERVAL \"" . $_SESSION["filterPeriod"] . "\" DAY GROUP BY date_measure";
        }
        else if ($_SESSION["filterLocation"] == "NULL" && $_SESSION["minDate"] == "NULL" && $_SESSION["maxDate"] == "NULL" && $_SESSION["filterUser"] == "NULL" && $_SESSION["filterPeriod"] != "NULL") {
            // period without location and user filtering
            $sql = "SELECT id_measure, AVG(measure_value), date_measure FROM " . $this->table . " WHERE type_measure=\"" . $type_of_chart . "\" AND date_measure >= DATE(NOW()) - INTERVAL \"" . $_SESSION["filterPeriod"] . "\" DAY GROUP BY date_measure";
        } */