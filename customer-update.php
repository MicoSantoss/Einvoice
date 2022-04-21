<?php

require_once 'dbh.php';

if(isset($_POST['submit'])){

    $customerId = $_GET['id'];
    $customerName = $_POST['customerName'];
    $customerAdd = $_POST['customerAdd'];
    $customerNo = $_POST['customerNo'];
    $customerStatus = $_POST['customerStatus'];

    $sql = "UPDATE customers SET customerName = '".$customerName."', customerAdd = '".$customerAdd."', customerNo = '".$customerNo."', customerStatus = '".$customerStatus."' WHERE customerId='".$customerId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: customer.php");
    }
    else{
        echo "check query";
    }
}
else{
    header("location: customer-edit.php");
    exit();
}