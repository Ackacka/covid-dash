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

if (empty($_SESSION['loginUser'])) {
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
        include 'view/mainPage.php';
        die();
        break;
    case "loginPage":
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
        if (!isset($username)) {
            $username = '';
        }
        if (!isset($email)) {
            $email = '';
        }
        if (!isset($password)) {
            $password = '';
        }
        if (!isset($usernameError)) {
            $usernameError = '';
        }
        if (!isset($emailError)) {
            $emailError = '';
        }
        if (!isset($passwordError)) {
            $passwordError = '';
        }
        if (!isset($pwdCapital)) {
            $pwdCapital = '';
        }
        if (!isset($pwdLower)) {
            $pwdLower = '';
        }
        if (!isset($pwdNum)) {
            $pwdNum = '';
        }
        if (!isset($pwdNonword)) {
            $pwdNonword = '';
        }
        include 'view/addUser.php';
        die();
        break;
    case "addUser":
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $_SESSION['loginUser'] = $username;

        $usernameError = '';
        if ($username == '') { // || strlen(trim($userName) <= 0))
            $usernameError = 'Username is required.';
        } else if (strlen($username) < 4 || strlen($username) > 30) {
            $usernameError = 'Username must be between 4 and 30 characters';
        } else if (!preg_match('/^[A-Za-z]/', $username)) {
            $usernameError = 'Username must start with a letter';
        } else if (!UserDB::uniqueUsernameTest($username) === false) {
            $usernameError = 'Username already taken.';
        } else {
            $usernameError = '';
        }

        $emailError = '';
        if ($email == '') { //|| strlen(trim($email) <= 0))
            $emailError = 'Must be a valid email.';
        } else if (!UserDB::uniqueEmailTest($email) === false) {
            $emailError = 'Email already in use.';
        }

        $pwdCapital = "Must have a capital letter";
        $pwdLower = "Must have a lower case letter";
        $pwdNum = "Must include a number";
        $pwdNonword = "Must have a special character";
        $pwdLength = "Must be at least 12 characters long";
        $counter = 0;
        $password_valid = true;

        if (preg_match('/[A-Z+]/', $password)) {
            $counter += 1;
            $pwdCapital = "";
        }
        if (preg_match('/[a-z+]/', $password)) {
            $counter += 1;
            $pwdLower = "";
        }
        if (preg_match('/[0-9+]/', $password)) {
            $counter += 1;
            $pwdNum = "";
        }
        if (preg_match('/[\W+]/', $password)) {
            $counter += 1;
            $pwdNonword = "";
        }
        if ($counter < 3) {
            $passwordError = "Must meet at least 3 of the 4 requirements";
            $password_valid = false;
        } else {
            $pwdCapital = "";
            $pwdLower = "";
            $pwdNum = "";
            $pwdNonword = "";
            $passwordError = "";
            $password_valid = true;
        }
        if (strlen($password) < 12) {
            $passwordError = $pwdLength;
            $password_valid = false;
        } else {
            $password_valid = true;
        }

        if ($password_valid) {
            $pwdHash = password_hash($password, PASSWORD_BCRYPT);
        }


        //write user information to database
        if ($usernameError !== '' || $emailError !== '' || $passwordError !== '') {
            include("./view/addUser.php");
            die();
        } else {
            $user = new User($username, $email, $pwdHash);
            UserDB::addUser($user);
            include("./view/confirmation.php");
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
