<?php

session_start();
require_once 'dbh.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Dashboard</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <a href="Invoice.php"><button>Add Sale Invoice</button></a>
        <div class="profile">
            <!--<span class="fa fa-search"></span>-->
            <?php
            
            $sql = "SELECT * FROM users WHERE usersId = '$_SESSION[userId]';";
            $imgresult = mysqli_query($conn, $sql);
            $image = mysqli_fetch_assoc($imgresult);

            
            ?>

            <img src="uploads/<?php echo $image['usersImage'];?>" alt="" class="profile-image">
            <p class="profile-name">
            
            <?php 
			
			if(isset($_SESSION['userId']) && isset($_SESSION['username'])){
				echo $_SESSION['username'];
			}
			else{
				echo '<script>alert("Login Failed!");</script>';
				header('location: login.php');
			}

			?></p>
        </div>
    </nav>

    <!--sidebar-->

    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle">
        <span class="fa fa-bars"></span>
    </label>

    <div class="sidebar">
        <a href="index.php"><div class="sidebar-menu active-link">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="compinfo.php"><div class="sidebar-menu">
            <span class="fa fa-building"></span>
                <p>Company</p>
        </div></a>
        <a href="inventory.php"><div class="sidebar-menu">
            <span class="fa fa-archive"></span>
                <p>Inventory</p>
        </div></a>
        <a href="customer.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Customers</p>
        </div></a>
        <a href="receipts.php"><div class="sidebar-menu">
            <span class="fa fa-clipboard"></span>
                <p>Saved Invoice</p>
        </div></a>
        <a href="mop.php"><div class="sidebar-menu">
            <span class="fa fa-credit-card"></span>
                <p>Mode of Payment</p>
        </div></a>
        <!--<br><br>
        <br><br>
        <br><br>-->
        <!--break-->

        <!--<a href="#"><div class="sidebar-menu">
            <span class="fa fa-gear"></span>
                <p>Settings</p>
        </div></a>-->
        <a href="utility.php"><div class="sidebar-menu">
            <span class="fa fa-briefcase"></span>
                <p>Utilities</p>
        </div></a>
        <a href="feedback.php"><div class="sidebar-menu">
            <span class="fa fa-question-circle"></span>
                <p>Help & Support</p>
        </div></a>
        <a href="logout-init.php"><div class="sidebar-menu">
            <span class="fa fa-sign-out"></span>
                <p>Logout</p>
        </div></a>
    </div>

    <!--main dashboard-->

    <main>
        <?php $now = date('Y-m-d'); /* DATE TODAY */?>
        <div class="dashboard-container">
            <!--top cards-->
            <!--<div class="card total1">
                <div class="info">
                    <div class="info-detail">
                        <h3>Revenue</h3>
                        <p>total revenue</p>
                        <h2><?php
                            /*$sql = "SELECT * FROM users WHERE usersId = '$_SESSION[userId]';";
                            $userresult = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($userresult);
                            if($row['revenue']){
                            echo $row['revenue'];
                            }
                            else{
                                echo '0';
                            }*/
                            ?><span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
            </div>-->
            <div class="card total2">
                <div class="info">
                    <div class="info-detail">
                        <h3>Customers</h3>
                        <p>total customers</p>
                        <h2><?php   $sql = "SELECT * FROM customers WHERE sellerId = '$_SESSION[userId]';";
    		                        $custresult = mysqli_query($conn, $sql);
			                        $custresultCheck = mysqli_num_rows($custresult);
                                    echo $custresultCheck;
                            ?>
                        </h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-group"></i>
                    </div>
                </div>
            </div>
            <div class="card total3">
                <div class="info">
                    <div class="info-detail">
                        <h3>Invoices</h3>
                        <p>number of invoices</p>
                        <h2><?php   $sql = "SELECT * FROM receipt WHERE sellerId = '$_SESSION[userId]';";
    		                        $receiptresult = mysqli_query($conn, $sql);
			                        $receiptresultCheck = mysqli_num_rows($receiptresult);
                                    
                                    echo $receiptresultCheck;
                                    
                            ?></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                </div>
            </div>
            <div class="card total4">
                <div class="info">
                    <div class="info-detail">
                        <h3>Inventory</h3>
                        <p>total products</p>
                        <h2><?php   $sql = "SELECT * FROM inventory WHERE sellerId = '$_SESSION[userId]';";
    		                        $result = mysqli_query($conn, $sql);
			                        $resultCheck = mysqli_num_rows($result);
                                    echo $resultCheck;
                                    /*if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            if ($row['productQuan'] <= 10){
                                                echo '<script>alert("'.$row['productName'].' quantity low");</script>';
                                            }
                                        }
                                    }*/
                            ?>
                        </h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-archive"></i>
                    </div>
                </div>
            </div>

            <!--bottom cards-->

            <?php
            
            
            $changesql = "SELECT * FROM customers WHERE sellerId = '$_SESSION[userId]' AND customerStatus='New';";
            $changeresult = mysqli_query($conn, $changesql);
            $changeresultCheck = mysqli_num_rows($changeresult);
            

            if($changeresultCheck > 0){
                
                //echo $changeresultCheck;
                

                //$datesql = "UPDATE customers SET customerStatus='Loyal' WHERE PRINT DATEDIFF(regDate, '$now') <= 5";

                //$datesql = "SELECT * FROM customers WHERE "

                 

                while ($row = mysqli_fetch_assoc($changeresult)){

                    $customerId = $row['customerId'];
                    
                    $regdate = $row['regDate'];
                    $intregdate = strtotime($regdate);
                    $intnow = strtotime($now);
                    $diff = $intnow - $intregdate;
                    $dateDiff = round($diff / 86400);

                    //echo $dateDiff;

                    if($dateDiff >= 5){
                        //echo $dateDiff;
                        $datesql = "UPDATE customers SET customerStatus='Loyal' WHERE customerId='$customerId';";
                        mysqli_query($conn, $datesql);
                    }

                }
            }
            
            
            
            ?>




            <div class="card detail">
                <div class="detail-header">
                    <h2>New Customers</h2>
                    <a href="customer.php" class="button"><button>See more</button></a>
                </div>

                <?php
                
                $newsql = "SELECT * FROM customers WHERE sellerId = '$_SESSION[userId]' ORDER BY customerId DESC LIMIT 5;";
                
                $query_run = mysqli_query($conn, $newsql);                              
                
                if(mysqli_num_rows($query_run) > 0){
                
                ?>

                <table>
                    <tr>
                        <th>Customer Number</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Status</th>
                    </tr>
                    <?php   $ctr = 0;
                            while ($custrow = mysqli_fetch_assoc($query_run)){
                            if($ctr <= 5){?>
                        <tr>
                            <td><?php echo $custrow['customerId'];?></td>
                            <td><?php echo $custrow['customerName'];?></td>
                            <td><?php echo $custrow['customerAdd'];?></td>
                            <td><?php echo $custrow['customerNo'];?></td>
                            <td><?php echo $custrow['customerStatus'];?></td>
                        </tr>
                    <?php $ctr++;} }?>
                </table>
                <?php }?>

            </div>
            <div class="card item">
                <div class="detail-header">
                    <h2>Recent Items</h2>
                    <a href="inventory.php" class="button"><button>See more</button></a>
                </div>

                <?php 

                $newproductsql = "SELECT * FROM inventory WHERE sellerId = '$_SESSION[userId]' ORDER BY productId DESC LIMIT 5;";
                $product_run = mysqli_query($conn, $newproductsql); 
                
                if(mysqli_num_rows($product_run) > 0){

                ?>

                <table>
                    <tr>
                        <th>Item Number</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($product_run)){?>
                        <tr>
                                <td><?php echo $row['productId'];?></td>
                                <td><?php echo $row['productName'];?></td>
                                <td><?php echo $row['productPrice'];?></td>
                                <td><?php echo $row['productQuan'];?></td>
                            </tr>
                    <?php }?>
                </table>
                <?php }?>
            </div>
        </div>
    </main>


<?php 

$sql = "SELECT * FROM inventory WHERE sellerId = '$_SESSION[userId]';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        if ($row['productQuan'] <= 10){
            echo '<script>alert("'.$row['productName'].' quantity low");</script>';
        }
    }
}


?>




</body>
</html>