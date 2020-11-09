<!DOCTYPE html>
<?php 
date_default_timezone_set('America/Chicago');

$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
if (session_id() == '') {
    session_start();
    setcookie(session_name(), session_id(), time() + $lifetime);
}

require_once './model/database.php';
require_once './model/user.php';
require_once './model/userDB.php';
require_once './model/validation.php';
require_once './model/covidApi.php';

if(!isset($_SESSION['loginUser'])) {
 $_SESSION['loginUser'] = "defaultUser";   
}

if(!isset($_SESSION['roleType'])) {
 $_SESSION['roleType'] = 1;   
}


$action = filter_input(INPUT_POST, "action");
if ($action === null) {
    $action = filter_input(INPUT_GET, "action");
    if ($action === null) {
        $action = "mainPage";
    }
}

switch ($action) {
    case "mainPage":  
//        $dashInfo = covidApi::getCurrent();          
        include 'dashboard/mainPage.php';
        die();
        break;
    case "loginPage":
        if(!isset($usernameError)){$usernameError = '';}
        if(!isset($passwordError)){$passwordError = '';}
        if(!isset($username)){$username = '';}
        if(!isset($password)) {$password = '';}
        include 'account/account_login.php';
        die();
        break;
    case "userLogin":
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');        
        $pwdHash = userDB::getPassword($username);

        if (password_verify($password, $pwdHash)) {
            $passwordError = "";
            $_SESSION['loginUser'] = $username;
            $user = UserDB::getUserByUsername($username);
            $_SESSION['roleType'] = $user['roleTypeID'];
            $dashInfo = covidApi::getCurrent();
            include './dashboard/dashboard_mainDashboard.php';
            die();
            break;
            //more stuff if successful password match
        } else {
            $passwordError = "Password is invalid.";
        }

        if (!isset($passwordError)) {
            $passwordError = '';
        }
        if (!isset($usernameError)) {
            $usernameError = '';
        }
        if (!isset($username)) {
            $username = '';
        }
        if (!isset($password)) {
            $password = '';
        }

        include './account/account_login.php';
        die();
        break;
    case "dashboard":
        $dashInfo = covidApi::getCurrent();
        include './dashboard/dashboard_mainDashboard.php';
        die();
        break;
    case "showAddUser":
        if (!isset($firstName)) {
            $firstName = '';
        }
        if (!isset($lastName)) {
            $lastName = '';
        }
        if (!isset($email)) {
            $email = '';
        }
        if (!isset($username)) {
            $username = '';
        }
        if (!isset($password)) {
            $password = '';
        }
        if (!isset($city)) {
            $city = '';
        }
        if (!isset($state)) {
            $state = '';
        }
        if (!isset($zipcode)) {
            $zipcode = '';
        }
        
        if (!isset($firstNameError)) {
            $firstNameError = '';
        }
        if (!isset($lastNameError)) {
            $lastNameError = '';
        }
        if (!isset($emailError)) {
            $emailError = '';
        }
        if (!isset($usernameError)) {
            $usernameError = '';
        }
        if (!isset($passwordError)) {
            $passwordError = '';
        }
        if (!isset($cityError)) {
            $cityError = '';
        }
        if (!isset($stateError)) {
            $stateError = '';
        }
        if (!isset($zipcodeError)) {
            $zipcodeError = '';
        }
        include 'account/account_register.php';
        die();
        break;
    case "addUser":
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');    
        $city = filter_input(INPUT_POST, 'city');
        $state = $_POST['states'];
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $username = filter_input(INPUT_POST, 'username');        
        $password = filter_input(INPUT_POST, 'password');
                    
        $firstNameError = Validation::validNameComplete($firstName, 'First Name');
        $lastNameError = Validation::validNameComplete($lastName, 'Last Name');
        $emailError = Validation::validEmail($email, 'Email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "The email ".$email." is not a valid email.";
        } 
        if (!UserDB::uniqueEmailTest($email) === false) {
                $emailError = 'Email already in use.';
        }        
        $cityError = Validation::validCity($city, 'City');
        $stateError = Validation::validState($state, 'State');
        $zipcodeError = Validation::validZipcode($zipcode, 'Zipcode');
        $usernameError = Validation::validUsernameComplete($username, 'Username');
        if($username == "") {
            if (UserDB::uniqueUsernameTest($username) === false) {
            $usernameError = 'Username already taken.';
            }
        }       
        $passwordError = Validation::validPasswordComplete($password, 'Password');
        $pwdHash = password_hash($password, PASSWORD_BCRYPT);         
         
        //write user information to database
        if ($usernameError !== '' || $emailError !== '' || $passwordError !== '') {
            include("./account/account_register.php");
            die();
        } else {
            if(isset($_POST["admin"])) {
                $roleTypeID = 2;
                $user = new User($roleTypeID, $firstName, $lastName, $email, $username, $pwdHash, $city, $state, $zipcode);
                UserDB::addUser($user);
            } else {
                $roleTypeID = 1;
                $user = new User($roleTypeID, $firstName, $lastName, $email, $username, $pwdHash, $city, $state, $zipcode);
                UserDB::addUser($user);
            }
            
            $_SESSION['loginUser'] = $username;            
            include("./account/account_login.php");
            die();
        }
        break;
    case "logOut":
        session_destroy();
        $_SESSION['loginUser'] = 'defaultUser';
        $_SESSION['roleType'] = 1;
        include "./dashboard/mainPage.php";
        die();
        break;
}
?>
