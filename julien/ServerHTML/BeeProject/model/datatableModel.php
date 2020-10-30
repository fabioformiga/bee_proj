<?php
    class Datatable {
        public $cols;
        public $rows;
        public $index;
        public $measure_list;

        public function __construct() {
            $this->cols = array();
            $this->rows = array();
            $this->index = 1;
            $this->measure_list = array();
        }

        public function addColumns($id, $label, $pattern, $type) {
            array_push($this->cols, (object)array('id' => $id, 'label' => $label, 'pattern' => $pattern, 'type' => $type));
        }

        public function addRows($date, $value, $isHour, $isMinute, $time) {
            if(strpos($_SESSION["filterLocation"], ',') !== false) {
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
                $this->index++;
            } 
            else {
                $column = new Column($date, $value, $isHour, $isMinute, $time);
                array_push($this->rows, $column);
            }
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