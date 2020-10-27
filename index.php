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

if(!isset($_SESSION['loginUser'])) {
 $_SESSION['loginUser'] = "defaultUser";   
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
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covidtracking.com/v1/us/current.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $dResponse = json_decode($response, true);
        $dResponse = $dResponse[0];
        if (array_key_exists('error', $dResponse)) {
            $apiErr = $dResponse['message'];
        } else {
            
        }
        $err = curl_error($curl);
        if ($err !== '') {
            var_dump($err);
        }
        curl_close($curl);
        
        include 'view/mainPage.php';
        die();
        break;
    case "loginPage":
        if(!isset($usernameError)){$usernameError = '';}
        if(!isset($passwordError)){$passwordError = '';}
        if(!isset($username)){$username = '';}
        if(!isset($password)) {$password = '';}
        include 'view/login.php';
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
            
            include './view/mainPage.php';
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

        include './view/login.php';
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
        include 'view/addUser.php';
        die();
        break;
    case "addUser":
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');    
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $username = filter_input(INPUT_POST, 'username');        
        $password = filter_input(INPUT_POST, 'password');
        $userType = filter_input(INPUT_POST, 'userType');
                    
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
        $stateError = Validation::isNotEmpty($state, 'State');
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
            include("./view/addUser.php");
            die();
        } else {
            if(empty($_POST["admin"])) {
                $roleTypeID = 1;
                $user = new User($firstName, $lastName, $email, $city, $state, $zipcode, $username, $pwdHash, $roleTypeID);
                $userID = UserDB::addUser($user);
            } else {
                $roleTypeID = 2;
                $user = new User($firstName, $lastName, $email, $city, $state, $zipcode, $username, $pwdHash, $roleTypeID);
                $userID = UserDB::addUser($user);
            }
            $_SESSION['loginUser'] = $username;            
            include("./view/login.php");
            die();
        }
        break;
    case "logOut":
        $_SESSION['loginUser'] = 'defaultUser';
        include "./view/mainPage.php";
        die();
        break;
}
?>
