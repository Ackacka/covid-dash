<?php
class admin {
    private $userID, $username, $password, $roleTypeID;
    
    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->roleTypeID = 2;
    }

    
    function getUserID() {
        return $this->userID;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUserID($userID): void {
        $this->userID = $userID;
    }

    function setUsername($username): void {
        $this->username = $username;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function getRoleTypeID() {
        return $this->roleTypeID;
    }


            
    
}

?>
