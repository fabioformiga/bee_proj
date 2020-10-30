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

        function login($username, $password) {
            $username_err = "";
            $password_err = "";

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
                        
                    // Redirect user to welcome page
                    header('Location: welcome.php?action=listObjects');
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

        function logout() {
            // Unset all of the session variables
            $_SESSION = array();
        }
    }
?>