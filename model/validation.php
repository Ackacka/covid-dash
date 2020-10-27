<?php

class Validation {

    public static function isNotEmpty($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";
        } else {
            return "";
        }
    }

    public static function validInt($arg, $label) {
        $filtArg = filter_var($arg, FILTER_VALIDATE_INT);
        if ($filtArg === null || $filtArg === false) {
            return $label . ' must a valid integer' . "\n";
        } else {
            return "";
        }
    }
    
    //validate username, firstname, lastname (must start with a letter)
    public function startsWith($arg, $label) {
       if(!preg_match('/^\s*[a-z,A-Z]/', trim($arg))) {
           return $label . ' must start with a letter' . "\n";
       } else {
           return "";
       }
    }
    
    public function validUsername($arg, $label) {
       if(!preg_match('/^[a-zA-Z][a-zA-Z0-9]{3,29}$/', trim($arg))) {
           return $label . ' must be only letters and numbers between 4 and 30 long' . "\n";
       } else {
           return "";
       }
    }
    
    //validate username, firstname, lastname (4-30 chars)
    public function validLength($arg, $label) {
        if(!(strlen($arg) >= 4 && strlen($arg) <= 30)) {
            return $label . ' must be between 4 and 30 characters long' . "\n";
        } else {
            return "";
        }
    }
    
    //validate password
    public function PasswordValidation($arg) {
        
        //requires a digit, an uppercase letter, and must be 8+ characters long
        $pwPattern = "/(?=.*[[:digit:]])(?=.*[a-zA-Z]).*[[:print:]]{8,}/";
        
        if (preg_match($pwPattern, $arg)) {
            if (password_hash($arg, PASSWORD_BCRYPT) !== false) {
                $pwHash = password_hash($arg, PASSWORD_BCRYPT);
                return $pwHash;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
public function validUsernameComplete($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";
        } else if(!(strlen($arg) >= 4 && strlen($arg) <= 30)) {
            return $label . ' must be between 4 and 30 characters long' . "\n";
        } else if(!preg_match('/^\s*[a-z,A-Z]/', trim($arg))) {
           return $label . ' must start with a letter' . "\n";
        } else {
            return $label = '';
        }
    }
    
    public function validNameComplete($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";
        } else if(!(strlen($arg) >= 4 && strlen($arg) < 60)) {
            return $label . ' must be between 4 and 60 characters' . "\n";
        } else {
            return $label = '';
        }
    }

    public function validPasswordComplete($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";            
        } else if(!preg_match('/[A-Z]+/', $arg)) {
            return $label . ' must have a capital letter' . "\n";
        } else if(!preg_match('/[a-z]+/', $arg)) {
            return $label . ' must have a lower case letter' . "\n";
        } else if(!preg_match('/[0-9]+/', $arg)) {
            return $label . ' must include a number' . "\n";
        } else if(!preg_match('/[\W]+/', $arg)) {
            return $label . ' must have a special character' . "\n";
        } else if(strlen($arg) < 12) {
            return $label . ' must be at least 12 characters long' . "\n";
        } else {
            return $label = '';
        }
    }
    
    public function validCity ($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";            
        } else if(preg_match('/[0-9]+/', $arg)) {
            return $label . ' must only have letters' . "\n";
        } else {
            return $label = '';
        }
    }
    
    public function validZipcode ($arg, $label) {
        $filtArg = filter_var($arg, FILTER_VALIDATE_INT);
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";            
        } else if ($filtArg === null || $filtArg === false) {
            return $label . ' must a valid integer' . "\n";
        } else {
            return $label = '';
        }
    }
    
    public function validEmail ($arg, $label) {
        if ($arg === null || $arg === "") {
            return $label . ' must not be empty' . "\n";            
//        } else if (!filter_var($arg, FILTER_VALIDATE_EMAIL)) {
//            return $label = "The email ".$arg." is not a valid email.";
        } else {
            return $label = "";
        }
    }

}

