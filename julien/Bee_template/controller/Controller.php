<?php
//header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 1	); // 0 No show errors, 1

// User Controller
require_once './UserController.php';

// Filter Controller
require_once './FilterController.php';

// DropdownLocal Controller
require_once './DropdownLocalController.php';

// CheckboxHiveController Controller
require_once './CheckboxHiveController.php';

$action = filter_input(INPUT_POST, "action");
if (filter_input(INPUT_POST, "action") == NULL) {
    $action = filter_input(INPUT_GET, "action");
}

switch ($action){ 
    case 'checkbox_hive':
            try {
                $checkboxHive = new CheckboxHiveController();
                $res = $checkboxHive->loadCheckboxHive(filter_input(INPUT_POST, "local"));
                echo $res ;
            } catch(Exception $exc) {
                echo $exc->getTraceAsString();
            }
        break;
    case 'dropdown_local':
            try {
                $dropdownLocal = new DropdownLocalController();
                $res = $dropdownLocal->loadLocalDropdown();
                echo $res ;
            } catch(Exception $exc) {
                echo $exc->getTraceAsString();
            }
        break;
    case 'filter':
            try {
                $filter = new FilterController();
                $res = $filter->filter( filter_input(INPUT_POST, "type"), filter_input(INPUT_POST, "date"), filter_input(INPUT_POST, "local"), filter_input(INPUT_POST, "hive") );
                echo $res ;
            } catch(Exception $exc) {
                echo $exc->getTraceAsString();
            }
        break;
    case 'login';
            try {
                $user = new UserController();
                $res = $user->login( filter_input(INPUT_POST, "user"), filter_input(INPUT_POST, "password") );
                echo $res;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        break;
    default:
        break;
}