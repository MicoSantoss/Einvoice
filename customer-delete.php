<?php

require_once 'dbh.php';

if(isset($_GET['id'])){
    $customerId = $_GET['id'];
    $sql = "DELETE FROM customers WHERE customerId='".$customerId."';";
    $result = mysqli_query($conn, $sql);


    $receiptsql = "DELETE FROM receipt WHERE customerId='".$customerId."';";
    $receiptResult = mysqli_query($conn, $receiptsql);

    if($result && $receiptResult){
        header("location: customer.php");
    }
    else{
        echo "check query";
    }
}