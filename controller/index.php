<?php
    // Initialize the session
    session_start();
    ini_set('display_errors', 1);

    require '../config/lang.php';

    require('dashboardController.php');
    $dashboardController = new DashboardController();

    require('chartController.php');
    $chartController = new ChartController();

    require('warningController.php');
    $warningController = new WarningController();

    require('userController.php');
    $userController = new UserController();

    require('espController.php');
    $espController = new EspController();

    $action = filter_input(INPUT_POST, "action");
    if (filter_input(INPUT_POST, "action") == NULL) {
        $action = filter_input(INPUT_GET, "action");
    }

    if ($action != "") {
        switch ($action){
            case 'register':
                $userController->loadRegister();
            break;
            case 'login':
                if(empty($_POST['username']) && empty($_POST['password'])) {
                    if($action == "register") {
                        $userController->loadRegister();
                    } else {
                        $userController->loadLogin();
                    }
                } else {
                    $userController->login($_POST['username'], $_POST['password']);
                }
            break;               
            case 'chart':
                $chartController->loadChart(filter_input(INPUT_POST, "chart"));
            break;
            case 'measure':
                $chartController->getMeasure(filter_input(INPUT_POST, "MeasureType"));
            break;
            case 'getFilter':
                $chartController->getFilterList();
            break;
            case 'filterPeriod':
                $chartController->filterByPeriod(filter_input(INPUT_POST, "period"));
            break;
            case 'filterLocation':
                $chartController->filterByLocation(filter_input(INPUT_POST, "hive_name"));
            break;
            case 'filterDate':
                $chartController->filterByDate(filter_input(INPUT_POST, "min_date"), filter_input(INPUT_POST, "max_date"), filter_input(INPUT_POST, "filter_date_mode"));
            break;
            case 'filterUser':
                $chartController->filterByUser(filter_input(INPUT_POST, "username"));
            break;
            case 'resetFilter':
                $chartController->resetFilter();
            break;
            case 'changeHour':
                $chartController->getHour(filter_input(INPUT_POST, "Hour"));
            break;
            case 'receive_esp':
                $espController->storeESPData(filter_input(INPUT_POST, "hive"), filter_input(INPUT_POST, "temp"), filter_input(INPUT_POST, "humi"), filter_input(INPUT_POST, "weight"));
            break;
            case 'warning':
                $warningController->loadWarning();
            break;
            case 'disconnect':
                $userController->logout();
            break;
        }
    } else {
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            if($action == "register") {
                $userController->loadRegister();
            } else {
                $userController->loadLogin();
            }
        } else {
            $dashboardController->loadDashboard();
        }
    }
?>
