<?php

function emptyInputSignup($name, $address, $contact, $status){
    $result = true;
    if(empty($name) || empty($address) || empty($contact) || empty($status)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

/*function customerExists($conn, $name, $address, $contact){
    $sql = "SELECT * FROM customers WHERE usersUid = ? OR usersEmail = ?;";
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
}*/

function createCustomer($conn, $name, $address, $contact, $status, $customerId, $sellerId, $now){
    $sql = "INSERT INTO customers (sellerId, customerId, customerName, customerAdd, customerNo, customerStatus, regDate) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: customers.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iississ", $sellerId, $customerId, $name, $address, $contact, $status, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: customer.php?error=none");
    exit();
    //Customer Input successful
}

function invalidNumber($contact){
    $result = true;
    $numlength = strlen((string)$contact);
    if ($numlength < 11 || $numlength > 11){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}


//Customer Edit
function emptyInputSearch($searchValue){
    $result = true;
    if(empty($searchValue)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}