<?php

require_once 'dbh.php';

if(isset($_GET['id'])){
    $productId = $_GET['id'];
    $sql = "DELETE FROM inventory WHERE productId='".$productId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: inventory.php");
    }
    else{
        echo "check query";
    }
}