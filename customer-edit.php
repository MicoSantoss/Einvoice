<?php

session_start();
require_once 'dbh.php';

if(isset($_GET['id'])){
	$customerId = $_GET['id'];
	$sql = "SELECT * FROM customers WHERE customerId='".$customerId."';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
    	$customerId = $row['customerId'];
    	$customerName = $row['customerName'];
        $customerAdd = $row['customerAdd'];
    	$customerNo = $row['customerNo'];
    	$customerStatus = $row['customerStatus'];
	}
}
else{
	header("location: customer.php?error=emptyinput");
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
    
    <title>Edit Customer</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <!--<a href="#"><button>Add Sale Invoice</button></a>-->
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
        <a href="inventory.php"><div class="sidebar-menu">
            <span class="fa fa-archive"></span>
                <p>Inventory</p>
        </div></a>
        <a href="customer.php"><div class="sidebar-menu active-link">
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
        <div class="compinfo-container">
            <form action="customer-update.php?id=<?php echo $customerId;?>" method="post">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Edit Customer Information</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">Customer Name</span>
                            <input type="text" name="customerName" placeholder="Enter Product Name" value="<?php echo $customerName;?>">
                        </div>
                        <div class="input box3">
                            <span class="details">Customer Address</span>
                            <input type="text" name="customerAdd" placeholder="Enter Address" value="<?php echo $customerAdd;?>">
                        </div>
                        <div class="input box4">
                            <span class="details">Contact Number</span>
                            <input type="text" name="customerNo" placeholder="Enter Quantity" value="<?php echo $customerNo;?>">
                        </div>
                        <div class="input box5">
                            <span class="details">Status</span>
                            <select type="text" name="customerStatus" value="<?php echo $customerStatus;?>">
                                <option value="Loyal">Loyal</option>
                                <option value="Bogus">Bogus</option>
                            </select>
                            <!--<input type="text" name="customerStatus" list="status" value="<?php //echo $customerStatus;?>" readonly>-->
                        </div>
                        <input style="width: 30%;" type="submit" name="submit" value="Update" class="editbutton">
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