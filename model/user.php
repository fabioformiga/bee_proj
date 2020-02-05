<?php

class User {    
    private $username;
    private $password;
    private $id_user;
                   
    public function __construct(){
        
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getIdUser() {
        return $this->id_user;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setIdUser($id_user) {
        $this->id_user = $id_user;
    }
}
