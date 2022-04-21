<?php

require_once 'dbh.php';

if(isset($_GET['id'])){
    $customerId = $_GET['id'];
    $sql = "DELETE FROM response WHERE usersId='".$customerId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: admin-feedback.php");
    }
    else{
        echo "check query";
    }
}