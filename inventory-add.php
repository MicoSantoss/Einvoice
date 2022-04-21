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
    
    <title>Add Product</title>
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
            <!--top cards-->
            <!--bottom cards-->
            <form action="inventory-add-init.php" method="post">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Add Product</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">Product Name</span>
                            <input type="text" name="productName" placeholder="Enter Product Name">
                        </div>
                        <div class="input box3">
                            <span class="details">Price</span>
                            <input type="text" name="productPrice" placeholder="Enter Price">
                        </div>
                        <div class="input box4">
                            <span class="details">Quantity</span>
                            <input type="text" name="productQuan" placeholder="Enter Quantity">
                        </div>
                        <input style="width: 30%;" type="submit" name="submit" value="Add" class="editbutton">
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