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

        $roleTypeID = $user->getRoleTypeID();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $city = $user->getCity();
        $state = $user->getState();
        $zipcode = $user->getZipcode();

        try {
            // Add the user to the database  
            $query = 'INSERT INTO users
                     (roleTypeID, firstName, lastName, email, username, password, city, state, zipcode)
                  VALUES
                     (:roleTypeID, :firstName, :lastName, :email, :username, :password, :city, :state, :zipcode)';
            $statement = $db->prepare($query);
            $statement->bindValue(':roleTypeID', $roleTypeID);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':zipcode', $zipcode);
            $statement->execute();
            $statement->closeCursor();
//            return $userID;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include("index.php");
            exit();
        }
    }

    public static function deleteUser($userID) {
        $db = Database::getDB();
        $query = 'DELETE FROM users WHERE userID = :userID';
        $statement = $db->prepare($query);
        $statement->bindValue(":userID", $userID);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function updateLocation($state, $username) {
        $db = Database::getDB();
        $query = 'UPDATE users SET state = :state WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(":state", $state);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function getLocation($username) {
        $db = Database::getDB();
        $query = 'SELECT state FROM users
                  WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $state = $statement->fetch();
        $statement->closeCursor();
        
        return $state;
    }

}
