<?php

//Signup functions
function emptyInputSignup($email, $username, $pwd, $confirmpwd){
    $result = true;
    if(empty($email) || empty($username) || empty($pwd) || empty($confirmpwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = true;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdmatch($pwd, $confirmpwd){
    $result = true;
    if($pwd !== $confirmpwd){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createuser($conn, $email, $username, $pwd, $userId, $userimage){
    $sql = "INSERT INTO users (usersID, usersEmail, usersUid, usersPwd, usersImage) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "issss", $userId, $email, $username, $hashedpwd, $userimage);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: login.php?error=none");
    exit();
    //signup successful
}



//login functions
function emptyInputLogin($username, $pwd){
    $result = true;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists == false){
        header("location: login.php?error=wronglogin");
        exit();
    }
    $pwdhashed = $uidExists["usersPwd"];
    $checkpwd = password_verify($pwd, $pwdhashed);

    if ($checkpwd == false){
        header("location: login.php?error=wronglogin");
        exit();
    }
    else if ($checkpwd == true){
        //echo '<script>alert("Login Success");</script>';
        session_start();
        $_SESSION["userId"] = $uidExists["usersID"];
        $_SESSION["username"] = $uidExists["usersUid"];
        //echo '<script>alert("Login Success");</script>';
        header("location: index.php");
        exit();
    }
}