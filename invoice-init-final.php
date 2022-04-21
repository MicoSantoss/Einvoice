<?php

session_start();



if (isset($_POST['submit'])){

    $productId = $_POST['productId'];
    $sellerId = $_SESSION['userId'];
    $customerId = $_SESSION['customerId'];



    require_once 'dbh.php';


    echo $productId;



    
    /*

    $sql = "SELECT * FROM inventorytemp WHERE productId = '$productId';";
    $result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    $productName = $row['productName'];
    $productPrice = $row['productPrice'];
    $productQuan = $row['productQuan'];
    $newProductPrice = $row['productPrice'];
    $productInitprice = $row['initPrice'];
    

    $insertSql = "INSERT INTO inventorytemp (sellerId, productId, productName, productPrice, initPrice, productQuan) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $insertSql)){
        header("location: inventory.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iisddi", $sellerId, $productId, $productName, $newProductPrice, $productPrice, $productQuan);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: invoice-init.php?id=".$customerId);
    exit();*/


}

?>