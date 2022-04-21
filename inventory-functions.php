<?php

function emptyInputProduct($productName, $productPrice, $productQuan){
    $result = true;
    if(empty($productName) || empty($productPrice) || empty($productQuan)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function addProduct($conn, $productName, $productPrice, $productQuan, $sellerId, $productId){
    $sql = "INSERT INTO inventory (sellerId, productId, productName, productPrice, productQuan) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: inventory.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iisdi", $sellerId, $productId, $productName, $productPrice, $productQuan);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: inventory.php?error=none");
    exit();
    //Customer Input successful
}


//invoicing
function emptyInputSearch($searchValue){
    $result = true;
    if(empty($searchValue)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}