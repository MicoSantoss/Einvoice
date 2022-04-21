<?php

require_once 'dbh.php';

if(isset($_GET['id'])){
    $receiptId = $_GET['id'];
    $sql = "DELETE FROM receipt WHERE invoiceNo='".$receiptId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: receipts.php");
    }
    else{
        echo "check query";
    }
}