<?php

class User {
    private $userID, $username, $password, $email, $roleTypeID, $city, $state, $zip;
    
    function __construct($username, $password, $email, $city, $state, $zip) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->roleTypeID = 1;
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

    function getEmail() {
        return $this->email;
    }

    function getCity() {
        return $this->city;
    }

    function getState() {
        return $this->state;
    }

    function getZip() {
        return $this->zip;
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

    function setEmail($email): void {
        $this->email = $email;
    }

    function setCity($city): void {
        $this->city = $city;
    }

    function setState($state): void {
        $this->state = $state;
    }

    function setZip($zip): void {
        $this->zip = $zip;
    }

    function getRoleTypeID() {
        return $this->roleTypeID;
    }



    
}

