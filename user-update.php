<?php

require_once 'dbh.php';

if(isset($_POST['submit'])){

    $customerId = $_GET['id'];
    $customerName = $_POST['customerName'];
    $customerAdd = $_POST['customerAdd'];
    $customerNo = $_POST['customerNo'];
    $customerStatus = $_POST['customerStatus'];

    $sql = "UPDATE users SET usersUid = '".$customerName."', usersAdd = '".$customerAdd."', usersEmail = '".$customerNo."', usersDesc = '".$customerStatus."' WHERE usersID='".$customerId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: users.php");
    }
    else{
        echo "check query";
    }
}
else{
    header("location: user-edit.php");
    exit();
}