<?php

class Filter {    
    private $filter_date;
    private $filter_local;
    private $filter_hive;
    private $filter_type;
                   
    public function __construct(){
        
    }
    
    function getFilterType() {
        return $this->filter_type;
        //return $_SESSION['date'];
    }

    function getFilterDate() {
        return $this->filter_date;
        //return $_SESSION['date'];
    }

    function getFilterLocal() {
        return $this->filter_local;
        //return $_SESSION['local'];
    }

    function getFilterHive() {
        return $this->filter_hive;
        //return $_SESSION['hive'];
    }

    function setFilterType($filter_type) {
        $this->filter_type = $filter_type;
        //$_SESSION['hive'] = serialize($filter_hive);
    }

    function setFilterDate($filter_date) {
        $this->filter_date = $filter_date;
        //$_SESSION['date'] = serialize($filter_date);
    }

    function setFilterLocal($filter_local) {
        $this->filter_local = $filter_local;
        //$_SESSION['local'] = serialize($filter_local);
    }

    function setFilterHive($filter_hive) {
        $this->filter_hive = $filter_hive;
        //$_SESSION['hive'] = serialize($filter_hive);
    }
}
