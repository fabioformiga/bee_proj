<?php
    class Datatable {
        public $cols;
        public $rows;
        public $index;
        public $hive_counter;
        public $measure_list;

        public function __construct() {
            $this->cols = array();
            $this->rows = array();
            $this->index = 1;
            $this->hive_counter = 0;
            $this->measure_list = $this->getHivesArray();
        }

        public function addColumns($id, $label, $pattern, $type) {
            array_push($this->cols, (object)array('id' => $id, 'label' => $label, 'pattern' => $pattern, 'type' => $type));
        }

        public function addRows($date, $value, $isHour, $isMinute, $time) {
            $column = new Column($date, $value, $isHour, $isMinute, $time);
            array_push($this->rows, $column);
        }

        public function getHivesArray() {
            $hives_session = str_replace("\"", "", $_SESSION["filterLocation"]);
            $list_hive = explode(",", $hives_session);
            $measure_list = array();
            foreach($list_hive as $hive_name) {
                $measure_list[$hive_name] = "";
            }
            $this->hive_counter = count($measure_list);
            return $measure_list;
        }

        public function addRowsHive($date, $value, $isHour, $isMinute, $time, $hive) {
            foreach($value as $columnValue) {
                $this->measure_list[$hive] = $value;
            }
            
            if($this->hive_counter == $this->index) {
                $value = $this->measure_list;
                $column = new Column($date, $value, $isHour, $isMinute, $time);
                array_push($this->rows, $column);
                $this->measure_list = $this->getHivesArray();
                $this->index = 1;
            } else {
                $this->index = $this->index + 1;
            }

/* 



                // If you have multiple selected
                $hive_count = count(explode(",", $_SESSION["filterLocation"]));
                //echo json_encode($this->$cols);
                foreach($value as $columnValue) {
                    array_push($this->measure_list, $columnValue);
                }
                if($this->index == $hive_count) {
                    //$name_hive = rtrim($this->measure_list, ",");
                    $value = $this->measure_list;
                    $column = new Column($date, $value, $isHour, $isMinute, $time);
                    array_push($this->rows, $column);
                    $this->measure_list = array();
                    $this->index = 0;
                }
                $this->index++; */
        }
    }

    class Column {
        public $c;

        public function __construct($date, $value, $isHour, $isMinute, $time) {
            $this->c = array();
            $month = intval($date[1])-1;
            if($isHour == "TRUE") {
                array_push($this->c, (object)array('v' => 'Date(' . $date[0] . ',' . $month . ',' . $date[2] . ',' . $time[0] . ')'));
            }
            elseif($isMinute == "TRUE") {
                array_push($this->c, (object)array('v' => 'Date(' . $date[0] . ',' . $month . ',' . $date[2] . ',' . $time[0] . ',' . $time[1] . ')'));
            }
            else {
                array_push($this->c, (object)array('v' => 'Date(' . $date[0] . ',' . $month . ',' . $date[2] . ')'));
            }

            foreach($value as $columnValue) {
                array_push($this->c, (object)array('v' => $columnValue));
            }
        }
    }