<?php
    require('../model/chartModel.php');
    require('../model/filterModel.php');
    require('../model/datatableModel.php');

    class ChartController {
        
        private $chartModel;
        private $filter;

        public function __construct() {
            $this->chartModel = new ChartModel();
            $this->filter = new FilterModel();
        }

        /*************************************************************

            CHART MANAGEMENT

        *************************************************************/
        function loadChart($chart) {
            $_SESSION["filterLocation"] = "NULL";
            $_SESSION["minDate"] = "NULL";
            $_SESSION["maxDate"] = "NULL";
            $_SESSION["filterUser"] = "NULL";
            $_SESSION["filterPeriod"] = "Year";
            $_SESSION["HourPeriod"] = "NULL";
            $Dashboard_view = "chart";
            $Chart_type = $chart;
            require('../views/chart/chartView.php');
        }

        /*************************************************************

            CHART MANAGEMENT

        *************************************************************/
        function getMeasure($type_of_measure) {
            $_SESSION["chart"] = $type_of_measure;
            $first_date = 1;
            $MeasureData = $this->chartModel->getMeasure($type_of_measure);
            $chart = new Datatable();
    
            if($_SESSION["filterPeriod"] == "Day") {
                $chart->addColumns("","Column","","date");
            } else {
                $chart->addColumns("","Column","","date");
            }

            if($_SESSION["filterLocation"] != "NULL") {
                $hives = str_replace("\"", "", $_SESSION["filterLocation"]);
                $list_hive = explode(",", $hives);
                foreach($list_hive as $hive) {
                    $chart->addColumns("", $hive ,"","number");
                }
            } else {
                $chart->addColumns("", $type_of_measure . " measure","","number");
            }

            foreach($MeasureData as $MeasureValue) {
                $date_complete = explode(" ", $MeasureValue['date_measure']);
                $date = explode("-", $date_complete[0]);
                $time = explode(":", $date_complete[1]);
                $month = intval($date[1])-1;
                $isHour = "FALSE";
                $isMinute = "FALSE";
                $time;
                // date(0-Year; 1-Month; 2-Day) time(0-Hour; 1-Minute; 2-Second)
                switch($_SESSION["filterPeriod"]) {
                    case 'Year':
                        if($first_date == 1) {
                            $first_date = $date[0] . "_" . $month;
                        }
                    break;
                    case 'Month':
                        if($first_date == 1) {
                            $first_date = $date[0] . "_" . $month. "_" . $date[2];
                        }
                    break;
                    case 'Week':
                        if($first_date == 1) {
                            $first_date = $date[0] . "_" . $month. "_" . $date[2];
                        }
                    break;
                    case 'Day':
                        if($first_date == 1) {
                            $first_date = $date[0] . "_" . $month. "_" . $date[2] . "_" . $time[0];  
                        }
                        $isHour = "TRUE";
                    break;
                    case 'Hour':
                        if($first_date == 1) {
                            $first_date = $date[0] . "_" . $month. "_" . $date[2] . "_" . $time[0];  
                        }
                        $isMinute = "TRUE";
                    break;
                }
                $chart->addRows($date, array($MeasureValue['AVG(measure_value)']), $isHour, $isMinute, $time);
            }
            echo $_SESSION["filterPeriod"] . "-" . $first_date . "/";
            echo json_encode($chart);
        }

        function getHour($hour) {
            $this->filter->setFilterHour($hour);
            $this->getMeasure($_SESSION["chart"]);
        }

        /*************************************************************

            FILTER MANAGEMENT

        *************************************************************/
        function getFilterList() {
            $filterHiveList = array();
            $filterHiveList[0] = $this->filter->getHiveNames();
            $filterHiveList[1] = $this->filter->getHiveUsers();
            echo json_encode($filterHiveList);
        }

        function filterByLocation($name_hive) {
            if($name_hive == "default") {
                $_SESSION["filterLocation"] = "NULL";
            } else {
                if(strpos($name_hive, ',') !== false) {
                    $list_hive = explode(",", $name_hive);
                    $name_hive = "";
                    foreach($list_hive as $hive) {
                        $name_hive .= "\"". $hive . "\",";
                    }
                    $name_hive = rtrim($name_hive, "\"");
                    $name_hive = rtrim($name_hive, ",");
                }
                else {
                    $name_hive = "\"".$name_hive."\"";
                }
                $this->filter->setFilterLocation($name_hive);
            }
            $this->getMeasure($_SESSION["chart"]);
        }

        function filterByDate($min_date, $max_date, $filter_date_mode) {
            $this->filter->setFilterDate($min_date, $max_date, $filter_date_mode);
            $this->getMeasure($_SESSION["chart"]);
        }

        function filterByUser($username) {
            $this->filter->setFilterUser($username);
            $this->getMeasure($_SESSION["chart"]);
        }

        function filterByPeriod($period) {
            $this->filter->setFilterPeriod($period);
            $this->getMeasure($_SESSION["chart"]);
        }

        function resetFilter() {
            $_SESSION["filterLocation"] = "NULL";
            $_SESSION["minDate"] = "NULL";
            $_SESSION["maxDate"] = "NULL";
            $_SESSION["filterUser"] = "NULL";
            $this->getMeasure($_SESSION["chart"]);
        }
    }
?>