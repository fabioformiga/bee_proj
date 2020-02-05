<?php
     require('../model/userModel.php');

    class UserController {
        
        private $user;

        public function __construct() {
            $this->user = new UserModel();
        }

        /*************************************************************

            AUTH MANAGEMENT

        *************************************************************/

        function loadLogin() { 
            $username_err = "";
            $password_err = "";
            $username = ""; 
            $password = "";
            require('../views/auth/login.php');
        }

        function loadRegister() { 
            $username = $password = $confirm_password = "";
            $username_err = $password_err = $confirm_password_err = "";
             
            require('../views/auth/register.php');
        }

        function login($username, $password) {
            $username_err = "";
            $password_err = "";
            $hive_user_list = "";

            // Check if username is empty
            if(empty($username)){
                $username_err = "Please enter username.";
            } else{
                $this->user->setUsername($username);
            }
                
            // Check if password is empty
            if(empty($password)){
                $password_err = "Please enter your password.";
            } else{
                $this->user->setPassword($password);
            }

            $loginResponse = $this->user->login();

            if($loginResponse != 0) {
                if(password_verify($password, $loginResponse["password"])){
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $loginResponse["id_user"];
                    $_SESSION["username"] = $loginResponse["username"];
                    $this->user->setIdUser($loginResponse["id_user"]); 
                    $user_hives = $this->user->getUserHives();
                    foreach($user_hives as $user_hive) {
                        $hive_user_list .= "\"" . $user_hive["id_hive"] . "\",";
                    }
                    $hive_user_list = rtrim($hive_user_list, ",");
                    $_SESSION["hive_rights"] = $hive_user_list;
                        
                    // Redirect user to welcome page
                    header('Location: index.php');
                } else{
                    // Display an error message if password is not valid
                    $password_err = "The password you entered was not valid.";
                }
            } else{
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
            }
            require_once('../views/auth/login.php');
        } 

        function register($username, $password) {
            $username = $password = $confirm_password = "";
            $username_err = $password_err = $confirm_password_err = "";
             
            // Processing form data when form is submitted
            if($_SERVER["REQUEST_METHOD"] == "POST"){
 
                // Validate username
                if(empty(trim($_POST["username"]))){
                    $username_err = "Please enter a username.";
                } else{
                    $user = $this->user->checkLogin($username);
                    if($user != "FALSE") {
                        $username = trim($_POST["username"]);
                        $this->user->setUsername($username);
                    }
                    else {
                        $username_err = "This username is already taken.";
                    }
                }
                
                // Validate password
                if(empty(trim($_POST["password"]))){
                    $password_err = "Please enter a password.";     
                } elseif(strlen(trim($_POST["password"])) < 6){
                    $password_err = "Password must have, at least, 6 characters.";
                } else{
                    $password = trim($_POST["password"]);
                    $this->user->setPassword($password);
                }
                
                // Validate confirm password
                if(empty(trim($_POST["confirm_password"]))){
                    $confirm_password_err = "Please confirm password.";     
                } else{
                    $confirm_password = trim($_POST["confirm_password"]);
                    if(empty($password_err) && ($password != $confirm_password)){
                        $confirm_password_err = "Password did not match.";
                    }
                }
                
                // Check input errors before inserting in database
                if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
                    $insert = $this->user->register();
                    if(empty($insert)) {
                        echo "Something went wrong. Please try again later.";
                    } else {
                        header("location: index.php");
                    }
                }
                require_once('../views/auth/register.php');
            }
        }

        function logout() {
            // Unset all of the session variables
            $_SESSION = array();
            header('Location: index.php');
        }
    }
?>