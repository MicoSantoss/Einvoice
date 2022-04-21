<?php

session_start();
require_once 'dbh.php';


if(isset($_GET['id'])){
    $productId = $_GET['id'];
    $customerId = $_SESSION['customerId'];
    $sql = "DELETE FROM inventorytemp WHERE productId='".$productId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: invoice-init.php?id=$customerId");
    }
    else{
        echo "check query";
    }
}