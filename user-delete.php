<?php

require_once 'dbh.php';

if(isset($_GET['id'])){
    $customerId = $_GET['id'];
    $sql = "DELETE FROM users WHERE usersID='".$customerId."';";
    $result = mysqli_query($conn, $sql);


    /*$receiptsql = "DELETE FROM receipt WHERE customerId='".$customerId."';";
    $receiptResult = mysqli_query($conn, $receiptsql);*/

    if($result){
        header("location: users.php");
    }
    else{
        echo "check query";
    }
}