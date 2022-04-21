<?php

require_once 'dbh.php';
session_start();

if(isset($_POST['submit'])){
    $sellerId = $_SESSION['userId'];
    $no1 = $_POST['eoi'];
    $no2 = $_POST['eou'];
    $no3 = $_POST['hc'];
    $no4 = $_POST['osc'];
    $no5 = $_POST['sec'];
    $no6 = $_POST['abm'];
    $no7 = $_POST['cit'];
    $no8 = $_POST['qoi'];
    $no9 = $_POST['aar'];
    $no10 = $_POST['aps'];
    $no11 = $_POST['qps'];
    $no12 = $_POST['vfm'];
    $no13 = $_POST['or'];
    $no14 = $_POST['op'];
    $comments = $_POST['comments'];

    //no1
    if ($no1 == 1){
        $no1 = 'unsatisfied';
    }
    elseif($no1 == 2){
        $no1 = 'somewhatunsatisfied';
    }
    elseif($no1 == 3){
        $no1 = 'neutral';
    }
    elseif($no1 == 4){
        $no1 = 'somewhatsatisfied';
    }
    elseif($no1 == 5){
        $no1 = 'satisfied';
    }


    //no2
    if ($no2 == 1){
        $no2 = 'unsatisfied';
    }
    elseif($no2 == 2){
        $no2 = 'somewhatunsatisfied';
    }
    elseif($no2 == 3){
        $no2 = 'neutral';
    }
    elseif($no2 == 4){
        $no2 = 'somewhatsatisfied';
    }
    elseif($no2 == 5){
        $no2 = 'satisfied';
    }


    //no3
    if ($no3 == 1){
        $no3 = 'unsatisfied';
    }
    elseif($no3 == 2){
        $no3 = 'somewhatunsatisfied';
    }
    elseif($no3 == 3){
        $no3 = 'neutral';
    }
    elseif($no3 == 4){
        $no3 = 'somewhatsatisfied';
    }
    elseif($no3 == 5){
        $no3 = 'satisfied';
    }


    //no4
    if ($no4 == 1){
        $no4 = 'unsatisfied';
    }
    elseif($no4 == 2){
        $no4 = 'somewhatunsatisfied';
    }
    elseif($no4 == 3){
        $no4 = 'neutral';
    }
    elseif($no4 == 4){
        $no4 = 'somewhatsatisfied';
    }
    elseif($no4 == 5){
        $no4 = 'satisfied';
    }


    //no5
    if ($no5 == 1){
        $no5 = 'unsatisfied';
    }
    elseif($no5 == 2){
        $no5 = 'somewhatunsatisfied';
    }
    elseif($no5 == 3){
        $no5 = 'neutral';
    }
    elseif($no5 == 4){
        $no5 = 'somewhatsatisfied';
    }
    elseif($no5 == 5){
        $no5 = 'satisfied';
    }


    //no6
    if ($no6 == 1){
        $no6 = 'unsatisfied';
    }
    elseif($no6 == 2){
        $no6 = 'somewhatunsatisfied';
    }
    elseif($no6 == 3){
        $no6 = 'neutral';
    }
    elseif($no6 == 4){
        $no6 = 'somewhatsatisfied';
    }
    elseif($no6 == 5){
        $no6 = 'satisfied';
    }


    //no7
    if ($no7 == 1){
        $no7 = 'unsatisfied';
    }
    elseif($no7 == 2){
        $no7 = 'somewhatunsatisfied';
    }
    elseif($no7 == 3){
        $no7 = 'neutral';
    }
    elseif($no7 == 4){
        $no7 = 'somewhatsatisfied';
    }
    elseif($no7 == 5){
        $no7 = 'satisfied';
    }


    //no8
    if ($no8 == 1){
        $no8 = 'unsatisfied';
    }
    elseif($no8 == 2){
        $no8 = 'somewhatunsatisfied';
    }
    elseif($no8 == 3){
        $no8 = 'neutral';
    }
    elseif($no8 == 4){
        $no8 = 'somewhatsatisfied';
    }
    elseif($no8 == 5){
        $no8 = 'satisfied';
    }


    //no9
    if ($no9 == 1){
        $no9 = 'unsatisfied';
    }
    elseif($no9 == 2){
        $no9 = 'somewhatunsatisfied';
    }
    elseif($no9 == 3){
        $no9 = 'neutral';
    }
    elseif($no9 == 4){
        $no9 = 'somewhatsatisfied';
    }
    elseif($no9 == 5){
        $no9 = 'satisfied';
    }


    //no10
    if ($no10 == 1){
        $no10 = 'unsatisfied';
    }
    elseif($no10 == 2){
        $no10 = 'somewhatunsatisfied';
    }
    elseif($no10 == 3){
        $no10 = 'neutral';
    }
    elseif($no10 == 4){
        $no10 = 'somewhatsatisfied';
    }
    elseif($no10 == 5){
        $no10 = 'satisfied';
    }


    //no11
    if ($no11 == 1){
        $no11 = 'unsatisfied';
    }
    elseif($no11 == 2){
        $no11 = 'somewhatunsatisfied';
    }
    elseif($no11 == 3){
        $no11 = 'neutral';
    }
    elseif($no11 == 4){
        $no11 = 'somewhatsatisfied';
    }
    elseif($no11 == 5){
        $no11 = 'satisfied';
    }


    //no12
    if ($no12 == 1){
        $no12 = 'unsatisfied';
    }
    elseif($no12 == 2){
        $no12 = 'somewhatunsatisfied';
    }
    elseif($no12 == 3){
        $no12 = 'neutral';
    }
    elseif($no12 == 4){
        $no12 = 'somewhatsatisfied';
    }
    elseif($no12 == 5){
        $no12 = 'satisfied';
    }


    //no13
    if ($no13 == 1){
        $no13 = 'unsatisfied';
    }
    elseif($no13 == 2){
        $no13 = 'somewhatunsatisfied';
    }
    elseif($no13 == 3){
        $no13 = 'neutral';
    }
    elseif($no13 == 4){
        $no13 = 'somewhatsatisfied';
    }
    elseif($no13 == 5){
        $no13 = 'satisfied';
    }


    //no14
    if ($no14 == 1){
        $no14 = 'unsatisfied';
    }
    elseif($no14 == 2){
        $no14 = 'somewhatunsatisfied';
    }
    elseif($no14 == 3){
        $no14 = 'neutral';
    }
    elseif($no14 == 4){
        $no14 = 'somewhatsatisfied';
    }
    elseif($no14 == 5){
        $no14 = 'satisfied';
    }

    
    $sql = "INSERT INTO response (usersId, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11, no12, no13, no14, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: feedback.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "isssssssssssssss", $sellerId, $no1, $no2, $no3, $no4, $no5, $no6, $no7, $no8, $no9, $no10, $no11, $no12, $no13, $no14, $comments);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: feedback.php?error=none");
    exit();
    /*if($result){
        echo '<script>alert("Thank you for your support");</script>';
        header("location: feedback.php");
    }
    else{
        echo "check query";
    }*/

    //$sql = "UPDATE customers SET customerName = '".$customerName."', customerAdd = '".$customerAdd."', customerNo = '".$customerNo."', customerStatus = '".$customerStatus."' WHERE customerId='".$customerId."';";
    //$result = mysqli_query($conn, $sql);

    /*if($result){
        header("location: feed.php");
    }
    else{
        echo "check query";
    }*/
}
else{
    header("location: feedback.php");
    exit();
}