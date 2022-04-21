<?php

session_start();
require_once 'dbh.php';

if(isset($_GET['id'])){
	$productId = $_GET['id'];
	$sql = "SELECT * FROM inventory WHERE productId='".$productId."';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
    	$productId = $row['productId'];
    	$productName = $row['productName'];
    	$productPrice = $row['productPrice'];
    	$productQuan = $row['productQuan'];
	}
}
else{
	header("location: inventory.php?error=emptyinput");
}
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
    
    <title>Edit Inventory</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <!--<a href="invoice.php"><button>Add Sale Invoice</button></a>-->
        <div class="profile">
            <!--<span class="fa fa-search"></span>-->

            <?php
            
            $sql = "SELECT * FROM users WHERE usersId = '$_SESSION[userId]';";
            $imgresult = mysqli_query($conn, $sql);
            $image = mysqli_fetch_assoc($imgresult);

            
            ?>

            <img src="uploads/<?php echo $image['usersImage'];?>" alt="" class="profile-image">
            <p class="profile-name"><?php 
			
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
        <a href="index.php"><div class="sidebar-menu">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="compinfo.php"><div class="sidebar-menu">
            <span class="fa fa-building"></span>
                <p>Company</p>
        </div></a>
        <a href="inventory.php"><div class="sidebar-menu active-link">
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
        <div class="compinfo-container">
            <!--top cards-->
            <!--
            <div class="card total1">
                <div class="info">
                    <div class="info-detail">
                        <h3>Revenue</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="card total2">
                <div class="info">
                    <div class="info-detail">
                        <h3>Customers</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-group"></i>
                    </div>
                </div>
            </div>
            <div class="card total3">
                <div class="info">
                    <div class="info-detail">
                        <h3>invoices</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
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
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-archive"></i>
                    </div>
                </div>
            </div>
            -->
            <!--bottom cards-->
            <form action="inventory-update.php?id=<?php echo $productId;?>" method="post">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Edit Product Information</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">Product Name</span>
                            <input type="text" name="productName" placeholder="Enter Product Name" value="<?php echo $productName;?>">
                        </div>
                        <div class="input box3">
                            <span class="details">Price</span>
                            <input type="text" name="productPrice" placeholder="Enter Price" value="<?php echo $productPrice;?>">
                        </div>
                        <div class="input box4">
                            <span class="details">Quantity</span>
                            <input type="text" name="productQuan" placeholder="Enter Quantity" value="<?php echo $productQuan;?>">
                        </div>
                        <input style="  background-color: #4CAF50;
                                        border: none;
                                        border-radius: 5px;
                                        color: white;
                                        padding: 15px 32px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        margin: 16px 2px;
                                        cursor: pointer;
                                        width: 30%;" type="submit" name="submit" value="Update" class="editbutton">
                    </div>
                </div>
            </form>

            <!--<div class="card item">
                <div class="detail-header">
                    <h2>New Items</h2>
                    <button>See more</button>
                </div>
                <table>
                    <tr>
                        <th>Item Number</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>Morlock</td>
                        <td>0912344</td>
                        <td>Loyal</td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Morlock</td>
                        <td>0912344</td>
                        <td>Loyal</td>
                    </tr>
                </table>
            </div>-->
        </div>
    </main>
</body>
</html>