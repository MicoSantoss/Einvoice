<?php

require_once 'dbh.php';

if(isset($_POST['submit'])){

    $productId = $_GET['id'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuan = $_POST['productQuan'];



    $sql1 = "SELECT * FROM inventory WHERE productName = '$productName' AND productId = '$productId';";
    $result1 = mysqli_query($conn, $sql1);
    $resultCheck = mysqli_num_rows($result1);

    if($resultCheck > 0){
        header("location: inventory.php?error=nametaken");
        exit();
    }




    $sql = "UPDATE inventory SET productName = '".$productName."', productPrice = '".$productPrice."', productQuan = '".$productQuan."' WHERE productId='".$productId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: inventory.php");
    }
    else{
        echo "check query";
    }
}
else{
    header("location: index.php");
    exit();
}