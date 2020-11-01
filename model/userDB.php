<?php

class UserDB {

    public static function selectAll() {
        $db = Database::getDB();
        $query = 'SELECT * FROM users';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    public static function getUser($userID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM users
                  WHERE userID = :userID';
        $statement = $db->prepare($query);
        $statement->bindValue(":userID", $userID);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    public static function getUserByUserName($username) {
        $db = Database::getDB();
        $query = 'SELECT * FROM Users
                  WHERE username = :User_name';
        $statement = $db->prepare($query);
        $statement->bindValue(":User_name", $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $user;
    }
    
    public static function getPassword($username) {
        $db = Database::getDB();
        $query = 'SELECT password FROM users
                  WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $password = $statement->fetch();
        $statement->closeCursor();
        if ($password === false) {
            return false;
        }
        return $password[0];
    }

    public static function uniqueUsernameTest($username) {
        $db = Database::getDB();        
        $userQuery = 'SELECT username FROM users WHERE username = :username;';
        $userStatement = $db->prepare($userQuery);
        $userStatement->bindValue(':username', $username);
        $userStatement->execute();
        $uniqueUser = $userStatement->fetch();
        $userStatement->closeCursor();
        return $uniqueUser;
    }

    public static function uniqueEmailTest($email) {
        $db = Database::getDB();        
        $emailQuery = 'SELECT email FROM users WHERE email = :email;';
        $emailStatement = $db->prepare($emailQuery);
        $emailStatement->bindValue(':email', $email);
        $emailStatement->execute();
        $uniqueEmail = $emailStatement->fetch();
        $emailStatement->closeCursor();
        return $uniqueEmail;
    }

    public static function addUser($user) {
        $db = Database::getDB();

        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $roleTypeID = $user->getRoleTypeID();
        $city = $user->getCity();
        $state = $user->getState();
        $zip = $user ->getZip();

        try {
            // Add the user to the database  
            $query = 'INSERT INTO users
                     (roleTypeID, firstName, lastName, email, username, password, city, state, zip)
                  VALUES
                     (:roleTypeID, :firstName, :lastName, :email, :username, :password, :city, :state, :zip)';
            $statement = $db->prepare($query);
            $statement->bindValue(':roleTypeID', $roleTypeID);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':username', $username);            
            $statement->bindValue(':password', $password);                      
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':zip', $zip);
            
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include("index.php");
            exit();
        }
    }
}
