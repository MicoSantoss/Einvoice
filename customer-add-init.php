<?php

session_start();

if (isset($_POST["submit"])){
    $name = $_POST["customerName"];
    $address = $_POST["customerAdd"];
    $contact = $_POST["customerNo"];
    $status = $_POST["customerStatus"];
    $sellerId = $_SESSION['userId'];
    $customerId = 0;
    $now = date('Y-m-d');

    require_once 'dbh.php';
    require_once 'customer-functions.php';

    if(emptyInputSignup($name, $address, $contact, $status) !== false){
        header("location: customer-add.php?error=emptyinput");
        exit();
    }
    /*if(customerExists($conn, $name, $address, $contact) !== false){
        header("location: customer-add.php?error=usernametaken");
        exit();
    }*/

    if(invalidNumber($contact) !== false){
        header('location: customer-add.php?error=invalidnumber');
        exit();
    }

    createCustomer($conn, $name, $address, $contact, $status, $customerId, $sellerId, $now);
}
else {
    header("location: customer.php");
}