<?php

if (isset($_POST["submit"])){
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];
    $userId = 0;
    $userimage = 'IMG-61b782f31fe929.42178131.png';

    require_once 'dbh.php';
    require_once 'functions.php';

    if(emptyInputSignup($email, $username, $pwd, $confirmpwd) !== false){
        header("location: signup.php?error=emptyinput");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $confirmpwd)){
        header("location: signup.php?error=passwordnotmatch");
        exit();
    }
    if(uidExists($conn, $username, $email) !== false){
        header("location: signup.php?error=usernametaken");
        exit();
    }

    createuser($conn, $email, $username, $pwd, $userId, $userimage);
}
else {
    header("location: signup.php");
}