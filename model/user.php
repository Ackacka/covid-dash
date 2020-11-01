<?php

class User {
    private $userID, $roleTypeID, $firstName, $lastName, $email, $username, $password,  $city, $state, $zipcode;
    
    function __construct($roleTypeID, $firstName, $lastName, $email, $username, $password, $city, $state, $zipcode) {
        $this->roleTypeID = $roleTypeID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;  
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
        
    }

    public function getUserID() {
        return $this->userID;
    }
    public function getRoleTypeID() {
        return $this->roleTypeID;
    }
    public function getFirstName() {
        return $this->firstName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getCity() {
        return $this->city;
    }
    public function getState() {
        return $this->state;
    }
    public function getZipcode() {
        return $this->zipcode;
    }

    function setUserID($userID): void {
        $this->userID = $userID;
    }
    function setRoleTypeID($roleTypeID): void {
        $this->roleTypeID = $roleTypeID;
    }
    function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }
    function setLastName($lastName): void {
        $this->lastName = $lastName;
    }
    function setEmail($email): void {
        $this->email = $email;
    }
    function setUsername($username): void {
        $this->username = $username;
    }    
    function setPassword($password): void {
        $this->password = $password;
    }
    function setCity($city): void {
        $this->city = $city;
    }
    function setState($state): void {
        $this->state = $state;
    }
    function setZipcode($zipcode): void {
        $this->zipcode = $zipcode;
    }

    



    
}

