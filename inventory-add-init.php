<?php

session_start();

if (isset($_POST["submit"])){
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQuan = $_POST["productQuan"];
    $sellerId = $_SESSION['userId'];
    $productId = 0;

    require_once 'dbh.php';
    require_once 'inventory-functions.php';

    if(emptyInputProduct($productName, $productPrice, $productQuan) !== false){
        header("location: product-add.php?error=emptyinput");
        exit();
    }
    /*if(customerExists($conn, $name, $address, $contact) !== false){
        header("location: customer-add.php?error=usernametaken");
        exit();
    }*/

    addProduct($conn, $productName, $productPrice, $productQuan, $sellerId, $productId);
}
else {
    header("location: product-add.php");
}